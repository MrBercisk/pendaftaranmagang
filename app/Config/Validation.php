<?php

namespace Config;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var array
     */
    public $ruleSets = [
        \CodeIgniter\Validation\Rules::class,
        \CodeIgniter\Validation\FormatRules::class,
        \CodeIgniter\Validation\FileRules::class,
        \CodeIgniter\Validation\CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $nilai = [
        'nama_peserta' => [
            'label'  => 'Nama Peserta',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Peserta tidak boleh kosong!'
            ]
        ],
        'ketepatan_waktu' => [
            'label' => 'Ketepatan Waktu',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'kehadiran' => [
            'label' => 'Kehadiran',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'kemampuan_kerja' => [
            'label' => 'Kemampuan kerja',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'kualitas_kerja' => [
            'label' => 'Kualitas Kerja',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'kerjasama' => [
            'label' => 'Kerjasama',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'inisiatif' => [
            'label' => 'Inisiatif',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'rasa_percaya' => [
            'label' => 'Rasa Percaya',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
    
            ],
        ],
        'penampilan' => [
            'label' => 'Penampilan',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'tanggung_jawab' => [
            'label' => 'Tanggung Jawab',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'rata_rata' => [
            'label' => 'Rata-rata',
            'rules' => 'numeric',
            'errors' => [
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],
        'ketepatan_waktu' => [
            'label' => 'Ketepatan Waktu',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kolom {field} harus diisi',
                'numeric' => 'Kolom {field} harus berupa angka',
            ],
        ],

    ];

    //Validasi Data Kampus
    public $kampus = [
        'nama_kampus' => [
            'label' => 'Nama Kampus',
            'rules' => 'required|is_unique[tbl_kampus.nama_kampus]',
            'errors' => [
                'required' => 'Kolom {field} wajib diisi.',
                'is_unique' => 'Nama kampus sudah ada dalam database.'
            ]
        ]
    ];
    //Validasi Data bidang
    public $bidang = [
        'nama_bidang' => [
            'label'  => 'Nama bidang',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama bidang tidak boleh kosong!'
            ]
        ]
    ];
    public $mentor = [
        'nama_mentor' => [
            'label'  => 'Nama mentor',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama mentor tidak boleh kosong!'
            ]
        ]
    ];
    public $jadwal = [
        'nama_peserta' => [
            'label'  => 'Nama Peserta',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Peserta tidak boleh kosong!'
            ]
        ],

        'tanggal_mulai' => [
            'label'  => 'tanggal_mulai',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal Mulai tidak boleh kosong!'
            ]
        ],
        'tanggal_selesai' => [
            'label'  => 'tanggal_selesai',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal Selesai tidak boleh kosong!'
            ]
        ],
        'jam_bimbingan' => [
            'label'  => 'jam_bimbingan',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Jam Bimbingan tidak boleh kosong!'
            ]
        ],
        'tanggal_bimbingan' => [
            'label'  => 'tanggal_bimbingan',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal Bimbingan tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Data Kategori
    public $kategori = [
        'nama_kategori' => [
            'label'  => 'Nama kategori',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama kategori tidak boleh kosong!'
            ]
        ],
        'syarat' => [
            'label'  => 'Syarat',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Project tidak boleh kosong!'
            ]
        ],
        'tugas' => [
            'label'  => 'Tugas',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Definisi tidak boleh kosong!'
            ]
        ],
        'fitur' => [
            'label'  => 'Fitur',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Fitur tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Informasi Pendaftaran
    public $informasi = [
        'tgl_pendaftaran' => [
            'label'  => 'Tanggal Pendaftaran',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal pendaftaran tidak boleh kosong!'
            ]
        ],
        'tgl_pengumuman' => [
            'label'  => 'Tanggal Pengumuman',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tanggal pengumuman lulus administrasi tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Pendaftaran - Buat akun
    public $daftar_akun = [
        'nama' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
            ]
        ],
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ],
        'confirm_password' => [
            'label'  => 'Confirm Password',
            'rules'  => 'required|min_length[8]|matches[password]',
            'errors' => [
                'required' => 'Confirm Password Tidak Boleh Kosong!',
                'min_length' => 'Confirm Password Minimal 8 Karakter!',
                'matches' => 'Confirm Password Tidak Sama Dengan Password!',
            ]
        ]
    ];
    //Validasi Pendaftaran - Buat akun
    public $tambah_mentor = [
        'nama' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Lengkap Tidak Boleh Kosong!'
            ]
        ],
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email|is_unique[tbl_user.email]',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!',
                'is_unique' => 'Email Sudah Terdaftar!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ],
        'confirm_password' => [
            'label'  => 'Confirm Password',
            'rules'  => 'required|min_length[8]|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi Password Tidak Boleh Kosong!',
                'min_length' => 'Konfirmasi Password Minimal 8 Karakter!',
                'matches' => 'Konfirmasi Password Tidak Sama Dengan Password!',
            ]
        ],
        'bidang_id' => [
            'label'  => 'Bidang',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Bidang tidak boleh kosong!'
            ]
        ],
        'kategori_id' => [
            'label'  => 'Kategori',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Kategori tidak boleh kosong!'
            ]
        ],
    ];

    //Validasi Login
    public $login = [
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ]
    ];
    //Validasi Login
    public $magang = [
        'email' => [
            'label'  => 'Email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required' => 'Email Tidak Boleh Kosong!',
                'valid_email' => 'Email Tidak Valid!'
            ]
        ],
        'password' => [
            'label'  => 'Password',
            'rules'  => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password Tidak Boleh Kosong!',
                'min_length' => 'Password Minimal 8 Karakter!'
            ]
        ]
    ];

    //Validasi Pendaftran - Tahap satu (Biodata)
    public $tahap_satu = [
        'nama_peserta' => [
            'label' => 'Nama Peserta',
            'rules' => 'required|alpha',
            'errors' => [
                'required' => 'Nama Peserta tidak boleh kosong!',
                'alpha' => 'Nama Peserta hanya boleh berisi huruf'
            ]
        ],
    

        'nim' => [
            'label'  => 'NIM',
            'rules'  => 'required|numeric|max_length[12]',
            'errors' => [
                'required' => 'NIM Peserta tidak boleh kosong!',
                'numeric' => 'NIM Peserta hanya berisi angka!',
                'min_length' => 'NIM Peserta maksimal 12 angka!'
            ]
        ],
        'no_hp' => [
            'label'  => 'No. Handphone',
            'rules'  => 'required|numeric|max_length[12]',
            'errors' => [
                'required' => 'No. Handphone Peserta tidak boleh kosong!',
                'numeric' => 'No. Handphone Peserta hanya berisi angka!',
                'min_length' => 'No. Handphone Peserta maksimal 12 angka!'
            ]
        ],
        'alamat_peserta' => [
            'label'  => 'Alamat',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Alamat Peserta tidak boleh kosong!'
            ]
        ],

        'nama_kampus' => [
            'label'  => 'Nama Kampus',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama Kampus Peserta tidak boleh kosong!'
            ]
        ],

        'prodi' => [
            'label'  => 'Program Studi',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Program Studi Peserta tidak boleh kosong!'
            ]
        ],

        'keahlian' => [
            'label'  => 'Keahlian',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Keahlian Peserta tidak boleh kosong!'
            ]
        ],
        'tools' => [
            'label'  => 'Tools',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tools Yang Dikuasai Peserta tidak boleh kosong!'
            ]
        ],
        'judul' => [
            'label'  => 'Judul',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Judul Project Magang tidak boleh kosong!'
            ]
        ],

        'jenis_permohonan' => [
            'label'  => 'Jenis Permohonan',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Jenis Permohonan tidak boleh kosong!'
            ]
        ],
        'status_permohonan' => [
            'label'  => 'Status Permohonan',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Status Permohonan tidak boleh kosong!'
            ]
        ]
    ];

    //Validasi Pendaftran - Tahap dua (Pilih bidang Dan kategori)
    public $tahap_dua = [
        'bidang_id' => [
            'label'  => 'Bidang',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Bidang tidak boleh kosong!'
            ]
        ],
        'kategori_id' => [
            'label'  => 'Kategori',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Pilihan Kategori tidak boleh kosong!'
            ]
        ],

    ];

    //Validasi Pendaftran - Tahap tiga (Upload Berkas Pendaftaran)
    public $tahap_tiga = [
        'foto' => [
            'label'  => 'Foto',
            'rules'  => 'uploaded[foto]|max_size[foto,500]|max_dims[foto,354,472]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg]',
            'errors' => [
                'uploaded' => 'Foto Peserta tidak boleh kosong!',
                'max_size' => 'Ukuran File Foto Peserta maksimal 500Kb!',
                'max_dims' => 'Ukuran Dimensi Foto Peserta 3X4 cm!',
                'is_image' => 'Yang anda pilih bukan gambar!',
                'mime_in' => 'Format Foto Peserta tidak sesuai!'
            ]
        ],
        'berkas' => [
            'label'  => 'Berkas',
            'rules'  => 'uploaded[berkas]|max_size[berkas,2048]|ext_in[berkas,pdf]',
            'errors' => [
                'uploaded' => 'Berkas Peserta tidak boleh kosong!',
                'max_size' => 'Ukuran File Berkas Peserta maksimal 2Mb!',
                'ext_in' => 'Format File Berkas Peserta tidak sesuai!'
            ]
        ],
        'nda' => [
            'label'  => 'NDA',
            'rules'  => 'uploaded[nda]|max_size[nda,2048]|ext_in[nda,pdf]',
            'errors' => [
                'uploaded' => 'NDA Peserta tidak boleh kosong!',
                'max_size' => 'Ukuran File Berkas Peserta maksimal 2Mb!',
                'ext_in' => 'Format File Berkas Peserta tidak sesuai!'
            ]
        ],
        'surat_permohonan' => [
            'label'  => 'Surat Permohonan',
            'rules'  => 'uploaded[surat_permohonan]|max_size[surat_permohonan,1024]|ext_in[surat_permohonan,pdf]',
            'errors' => [
                'uploaded' => 'Harap Upload Surat Permohonan Magang Dari Univ!',
                'max_size' => 'Ukuran File Peserta maksimal 1Mb!',
                'ext_in' => 'Format File Peserta tidak sesuai!'
            ]
        ],
        'video_perkenalan' => [
            'label'  => 'Video Perkenalan',
            'rules'  => 'uploaded[video_perkenalan]|max_size[video_perkenalan,20000]|mime_in[video_perkenalan,video/mp4]',
            'errors' => [
                'uploaded' => 'Harap Upload Video Perkenalan!',
                'max_size' => 'Ukuran File Video Peserta maksimal 20Mb!',
                'mime_in' => 'Format File Peserta tidak sesuai!'
            ]
        ]
    ];
}
