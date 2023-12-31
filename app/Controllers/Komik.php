<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\CodeIgniter;

class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik | Faza Blog',
            'komik' => $this->komikModel->getKomik()
        ];

        //konek db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row){}

        // konek dg model
        // $komikModel = new \App\Models\KomikModel();
        // $komikModel = new KomikModel();


        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        // echo $slug;
        // $komik = $this->komikModel->where(['slug' => $slug])->first();
        // $komik = $this->komikModel->getKomik($slug);

        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik' . $slug . 'tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        //validasi input
        if(!$this->validate([
            'judul' => [
                'rules' =>'required|is_unique[komik.judul]',
                'errors' => [
                    'required' =>'{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
                ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image,png]',
                'errors' => [
                    'uploaded' => 'Gambar sampul wajib diisi',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            // $data ['validation'] = $validation;
            // return view('komik/create', $data);

            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            // return redirect()->to('/komik/create')->withInput();
            
        }

        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        //generate nama sampul random
        $namaSampul = $fileSampul->getRandomName();
        //pindahkan ke folder img
        $fileSampul->move('img');
        //ambil nama file sampul
        // $namaSampul = $fileSampul->getName();


        // $this->request->getVar();

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            // 'sampul' => $this->request->getVar('sampul')
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }

    public function delete($id){
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug){
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id) {
        // dd($this->request->getVar());

        // cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if(!$this->validate([
            'judul' => [
                // 'rules' =>'required|is_unique[komik.judul]',
                'rules' =>$rule_judul,
                'errors' => [
                    'required' =>'{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/komik/edit/'. $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/komik');
    }
}
