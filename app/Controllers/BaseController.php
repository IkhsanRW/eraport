<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use Psr\Log\LoggerInterface;

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

    protected $agama = [
        'Islam',
        'Kristen',
        'Katolik',
        'Hindu',
        'Buddha',
        'Konghucu'
    ];

    protected $month = [
        '1' => [
            'idn' => 'Januari',
            'eng' => 'January'
        ],
        '2' => [
            'idn' => 'Februari',
            'eng' => 'February'
        ],
        '3' => [
            'idn' => 'Maret',
            'eng' => 'March'
        ],
        '4' => [
            'idn' => 'April',
            'eng' => 'April'
        ],
        '5' => [
            'idn' => 'Mei',
            'eng' => 'May'
        ],
        '6' => [
            'idn' => 'Juni',
            'eng' => 'June'
        ],
        '7' => [
            'idn' => 'Juli',
            'eng' => 'July'
        ],
        '8' => [
            'idn' => 'Agustus',
            'eng' => 'August'
        ],
        '9' => [
            'idn' => 'September',
            'eng' => 'September'
        ],
        '10' => [
            'idn' => 'Oktober',
            'eng' => 'October'
        ],
        '11' => [
            'idn' => 'November',
            'eng' => 'November'
        ],
        '12' => [
            'idn' => 'Desember',
            'eng' => 'December'
        ],
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        date_default_timezone_set('Asia/Jakarta');
        if (session('log_auth')) {
            if (session('log_auth')['accountRole'] == '3') {
                helper('kelas_siswa');
                helper('siswa');
            } elseif (session('log_auth')['accountRole'] == '2') {
                helper('walikelas');
            }
        }
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected function redirectBack()
    {
        return "<script>window.history.back()</script>";
    }

    protected function redirectBackWithAlert(string $msg, string $key = 'danger')
    {
        session()->setFlashdata($key, $msg);
        return $this->redirectBack();
    }

    protected function patternDateIdn(): string
    {
        $tmp = "(";
        $i = 0;
        foreach ($this->month as $key => $val) {
            $tmp .= $val['idn'];
            if ($i != count($this->month) - 1) {
                $tmp .= "|";
            }
            $i++;
        }
        $tmp .= ")";
        return "(([0-2][0-9])|([3][0-1])) " . $tmp . "((19[0-9][0-9])|(20[0-1][0-9])|(202[0-3]))";
    }
}
