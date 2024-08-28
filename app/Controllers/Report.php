<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SalesModel;
use App\Models\SaleItemModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\BranchesModel; // Tambahkan ini di bagian atas file

class Report extends BaseController
{
    protected $saleModel;
    protected $saleItemModel;
    protected $branchModel;

    public function __construct()
    {
        $this->saleModel = new SalesModel();
        $this->saleItemModel = new SaleItemModel();
        $this->branchModel = new BranchesModel();
    }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $branchId = session()->get('branch_id');
        $data['salesData'] = $this->saleModel->getSalesSummary($branchId);
        
        if (session()->get('role') === 'owner') {
            $data['branches'] = $this->branchModel->findAll();
        }
        
        return $this->render('Report/index', $data);
    }

    public function exportExcel()
    {
        $userRole = session()->get('role');
        $branchId = ($userRole === 'owner') ? $this->request->getGet('branch_id') : session()->get('branch_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $paymentMethod = $this->request->getGet('payment_method');

        if (!$startDate || !$endDate) {
            return $this->response->setJSON(['error' => 'Tanggal awal dan akhir harus diisi.']);
        }

        $startDateTime = date('Y-m-d 00:00:00', strtotime($startDate));
        $endDateTime = date('Y-m-d 23:59:59', strtotime($endDate));

        $dailySalesData = $this->saleModel->getDailySalesData($branchId, $startDateTime, $endDateTime, $paymentMethod);
        $transactionsData = $this->saleModel->getTransactionsData($branchId, $startDateTime, $endDateTime, $paymentMethod);

        $spreadsheet = new Spreadsheet();
        $rupiahFormat = '_("Rp"* #,##0_);_("Rp"* \(#,##0\);_("Rp"* "-"??_);_(@_)';

        $this->createDailySalesSheet($spreadsheet, $dailySalesData, $startDate, $endDate, $rupiahFormat);
        $this->createTransactionDetailsSheet($spreadsheet, $transactionsData, $startDate, $endDate, $rupiahFormat);

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_penjualan_' . $startDate . '_' . $endDate . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    private function createDailySalesSheet($spreadsheet, $dailySalesData, $startDate, $endDate, $rupiahFormat)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Penjualan Harian');

        $this->setSheetHeader($sheet, 'Laporan Penjualan dan Keuntungan', $startDate, $endDate, 'A', 'C');

        $headers = ['Tanggal', 'Jumlah Transaksi', 'Total Pendapatan'];
        $sheet->fromArray($headers, NULL, 'A3');
        $sheet->getStyle('A3:C3')->getFont()->setBold(true);
        $sheet->getStyle('A3:C3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $row = 4;
        $totalTransactions = $totalRevenue = 0;
        foreach ($dailySalesData as $data) {
            $sheet->fromArray([$data['date'], $data['total_transactions'], $data['total_revenue']], NULL, 'A' . $row);
            $totalTransactions += $data['total_transactions'];
            $totalRevenue += $data['total_revenue'];
            $row++;
        }

        $this->setTotalRow($sheet, $row, $totalTransactions, $totalRevenue);
        $this->formatSheet($sheet, $row, $rupiahFormat);
    }

    private function createTransactionDetailsSheet($spreadsheet, $transactionsData, $startDate, $endDate, $rupiahFormat)
    {
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Detail Transaksi');

        $userRole = session()->get('role');
        $isOwner = ($userRole === 'owner');

        $headers = ['No. Transaksi', 'Tanggal', 'Metode Pembayaran', 'Total', 'Detail Produk'];
        if ($isOwner) {
            $headers[] = 'Cabang';
        }

        $this->setSheetHeader($sheet, 'Laporan Detail Transaksi', $startDate, $endDate, 'A', $isOwner ? 'F' : 'E');

        $sheet->fromArray($headers, NULL, 'A3');
        $sheet->getStyle('A3:' . ($isOwner ? 'F3' : 'E3'))->getFont()->setBold(true);
        $sheet->getStyle('A3:' . ($isOwner ? 'F3' : 'E3'))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        $row = 4;
        foreach ($transactionsData as $transaction) {
            $rowData = [
                $transaction['transaction_number'],
                $transaction['created_at'],
                ucfirst($transaction['payment_method']),
                $transaction['total_price'],
                $this->getItemDetails($transaction['id'])
            ];
            if ($isOwner) {
                $rowData[] = $transaction['branch_name'];
            }
            $sheet->fromArray($rowData, NULL, 'A' . $row);
            $row++;
        }

        $this->formatSheet($sheet, $row - 1, $rupiahFormat, true, $isOwner);
    }

    private function getItemDetails($saleId)
    {
        $saleItems = $this->saleItemModel->getSaleItems($saleId);
        return implode(', ', array_map(function ($item) { 
            return $item['product_name'] . ' (x' . $item['quantity'] . ')';
        }, $saleItems));
    }

    private function setSheetHeader($sheet, $title, $startDate, $endDate, $startCol, $endCol)
    {
        $sheet->setCellValue($startCol . '1', $title);
        $sheet->mergeCells($startCol . '1:' . $endCol . '1');
        $sheet->getStyle($startCol . '1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle($startCol . '1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue($startCol . '2', "Periode: " . date('d/m/Y', strtotime($startDate)) . " s/d " . date('d/m/Y', strtotime($endDate)));
        $sheet->mergeCells($startCol . '2:' . $endCol . '2');
        $sheet->getStyle($startCol . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    private function setTotalRow($sheet, $row, $totalTransactions, $totalRevenue)
    {
        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->setCellValue('B' . $row, $totalTransactions);
        $sheet->setCellValue('C' . $row, $totalRevenue);
        $sheet->getStyle('A' . $row . ':C' . $row)->getFont()->setBold(true);
        $sheet->getStyle('A' . $row . ':C' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
    }

    private function formatSheet($sheet, $lastRow, $rupiahFormat, $isTransactionSheet = false, $isOwner = false)
    {
        $lastCol = $isTransactionSheet ? ($isOwner ? 'F' : 'E') : 'C';
        $sheet->getStyle('A3:' . $lastCol . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle($isTransactionSheet ? 'D4:D' . $lastRow : 'C4:C' . $lastRow)->getNumberFormat()->setFormatCode($rupiahFormat);
        $sheet->getStyle('A4:' . ($isTransactionSheet ? 'D' : 'C') . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        if ($isTransactionSheet) {
            $sheet->getStyle('E4:E' . $lastRow)->getAlignment()->setWrapText(true);
        }

        foreach (range('A', $lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    public function getFilteredData()
    {
        $userRole = session()->get('role');
        $branchId = ($userRole === 'owner') ? $this->request->getGet('branch_id') : session()->get('branch_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $paymentMethod = $this->request->getGet('payment_method');

        if (!$startDate || !$endDate) {
            return $this->response->setJSON(['error' => 'Tanggal awal dan akhir harus diisi.']);
        }

        $startDateTime = date('Y-m-d 00:00:00', strtotime($startDate));
        $endDateTime = date('Y-m-d 23:59:59', strtotime($endDate));

        $dailySalesData = $this->saleModel->getDailySalesData($branchId, $startDateTime, $endDateTime, $paymentMethod);
        $transactionsData = $this->saleModel->getTransactionsData($branchId, $startDateTime, $endDateTime, $paymentMethod);

        return $this->response->setJSON([
            'dailySalesData' => $dailySalesData,
            'transactionsData' => $transactionsData
        ]);
    }
}
