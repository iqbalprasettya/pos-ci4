<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\StoreSettingsModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    protected $userData;
    protected $storeSettings;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        // Ambil data pengguna yang sedang login
        $this->userData = $this->getUserData();

        // Kirim data pengguna ke semua view
        $this->data['user'] = $this->userData;

        $this->storeSettings = new StoreSettingsModel();

        // Ambil pengaturan toko
        $storeSettings = $this->getStoreSettings();
        $this->data = array_merge($this->data, $storeSettings);
    }

    protected function getUserData()
    {
        // Implementasikan logika untuk mengambil data pengguna dari session atau database
        // Contoh sederhana (sesuaikan dengan sistem autentikasi Anda):
        $session = session();
        $userId = $session->get('user_id');

        if ($userId) {
            $userModel = new \App\Models\UserModel();
            return $userModel->find($userId);
        }

        return null;
    }

    // Tambahkan method render untuk mengirim data ke view
    protected function render($view, $data = [])
    {
        return view($view, array_merge($this->data, $data));
    }

    protected function getStoreSettings()
    {
        return [
            'store_name' => $this->storeSettings->getSetting('store_name'),
            'footer_text' => $this->storeSettings->getSetting('footer_text'),
        ];
    }
}