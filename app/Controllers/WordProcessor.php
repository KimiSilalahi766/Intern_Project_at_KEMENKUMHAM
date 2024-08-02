<?php
namespace App\Controllers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Shared\Converter;

class WordProcessor extends BaseController {

    public function index()
    {
        return view('form');
    }

    public function replace()
    {
        $rules = [
            'judul' => 'required',
            'alamat' => 'required',
            'telpon' => 'required',
            'manla' => 'required',
            'relsu' => 'required',
            'namsat' => 'required',
            'satker' => 'required',
            'triwulan' => 'required',
            'tahun' => 'required',
            'output' => 'required',
            'wulantri' => 'required',
            'hunta' => 'required',
            'putout' => 'required',
            'hambatan1' => 'required',
            'hambatan2' => 'required',
            'rencana1' => 'required',
            'rencana2' => 'required',
            'gambar_gbremonev' => 'uploaded[gambar_gbremonev]|max_size[gambar_gbremonev,2048]|is_image[gambar_gbremonev]',
            'gambar_gmbrsmart' => 'uploaded[gambar_gmbrsmart]|max_size[gambar_gmbrsmart,2048]|is_image[gambar_gmbrsmart]',
            'gambar_gbrerformance' => 'uploaded[gambar_gbrerformance]|max_size[gambar_gbrerformance,2048]|is_image[gambar_gbrerformance]',
        ];

        if (!$this->validate($rules)) {
            return view('form', [
                'validation' => $this->validator,
            ]);
        } else {
            // Load library PHPWord
            $phpWord = new PhpWord();

            // Dictionary untuk menggantikan kata-kata berdasarkan input form
            $replacements = array(
                'JUDUL' => $this->request->getPost('judul'),
                'Alamat' => $this->request->getPost('alamat'),
                'Telpon' => $this->request->getPost('telpon'),
                'manla' => $this->request->getPost('manla'),
                'relsu' => $this->request->getPost('relsu'),
                'NAMSAT' => $this->request->getPost('namsat'),
                'satker' => $this->request->getPost('satker'),
                'triwulan' => $this->request->getPost('triwulan'),
                'tahun' => $this->request->getPost('tahun'),
                'output' => $this->request->getPost('output'),
                'wulantri' => $this->request->getPost('wulantri'),
                'hunta' => $this->request->getPost('hunta'),
                'putout' => $this->request->getPost('putout'),
                'hambatan1' => $this->request->getPost('hambatan1'),
                'hambatan2' => $this->request->getPost('hambatan2'),
                'rencana1' => $this->request->getPost('rencana1'),
                'rencana2' => $this->request->getPost('rencana2')
            );

            // Path dari dokumen Word yang akan diupdate
            $docPath = WRITEPATH . 'filedox/laporanevaluasi.docx';
            $newDocPath = WRITEPATH . 'filedox/update_laporanevaluasi.docx';

            // Debug: Periksa apakah path dokumen Word benar
            if (!file_exists($docPath)) {
                log_message('error', 'Template file not found: ' . $docPath);
                return view('form', ['error' => 'Template file not found.']);
            }

            // Buka dokumen Word yang ada
            try {
                $document = IOFactory::load($docPath);
            } catch (\Exception $e) {
                log_message('error', 'Error loading Word document: ' . $e->getMessage());
                return view('form', ['error' => 'Error loading Word document.']);
            }

            // Proses dan simpan gambar yang diunggah
            $gambar_gbremonev = $this->request->getFile('gambar_gbremonev');
            $gambar_gmbrsmart = $this->request->getFile('gambar_gmbrsmart');
            $gambar_gbrerformance = $this->request->getFile('gambar_gbrerformance');

            // Generate unique names for each image
            $gbremonevName = $gambar_gbremonev->getRandomName();
            $gmbrsmartName = $gambar_gmbrsmart->getRandomName();
            $gbrerformanceName = $gambar_gbrerformance->getRandomName();

            if ($gambar_gbremonev->isValid() && !$gambar_gbremonev->hasMoved()) {
                $gambar_gbremonev->move(WRITEPATH . 'uploads', $gbremonevName);
                $replacements['gbremonev'] = WRITEPATH . 'uploads/' . $gbremonevName;
            }

            if ($gambar_gmbrsmart->isValid() && !$gambar_gmbrsmart->hasMoved()) {
                $gambar_gmbrsmart->move(WRITEPATH . 'uploads', $gmbrsmartName);
                $replacements['gmbrsmart'] = WRITEPATH . 'uploads/' . $gmbrsmartName;
            }

            if ($gambar_gbrerformance->isValid() && !$gambar_gbrerformance->hasMoved()) {
                $gambar_gbrerformance->move(WRITEPATH . 'uploads', $gbrerformanceName);
                $replacements['gbrerformance'] = WRITEPATH . 'uploads/' . $gbrerformanceName;
            }

            // Ganti kata-kata yang disorot
            foreach ($document->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getElements')) {
                        foreach ($element->getElements() as $childElement) {
                            if (method_exists($childElement, 'getText')) {
                                $text = $childElement->getText();
                                foreach ($replacements as $oldWord => $newWord) {
                                    if (strpos($text, $oldWord) !== false) {
                                        // Jika pengganti adalah path gambar, sisipkan gambar
                                        if (strpos($newWord, WRITEPATH) === 0) {
                                            // Menyisipkan gambar dan menghapus label yang sesuai
                                            $childElement->setText(''); // Menghapus teks placeholder

                                            // Mengambil ukuran gambar asli
                                            list($width, $height) = getimagesize($newWord);

                                            // Hitung rasio aspek
                                            $aspectRatio = $width / $height;

                                            // Set tinggi gambar yang diinginkan
                                            $desiredHeight = Converter::cmToPixel(10);

                                            // Hitung lebar berdasarkan rasio aspek
                                            $desiredWidth = $desiredHeight * $aspectRatio;

                                            // Menyisipkan gambar dengan ukuran yang sesuai
                                            $paragraph = $section->addTextRun(); // Membuat paragraf baru untuk gambar
                                            $paragraph->addTextBreak(); // Jeda sebelum gambar
                                            $paragraph->addImage($newWord, array(
                                                'width' => $desiredWidth, // Set lebar gambar sesuai rasio aspek
                                                'height' => $desiredHeight, // Set tinggi gambar
                                                'alignment' => Jc::CENTER, // Rata tengah
                                            ));
                                            $paragraph->addTextBreak(); // Jeda setelah gambar
                                        } else {
                                            $childElement->setText(str_replace($oldWord, $newWord, $text));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // Simpan dokumen Word yang telah diperbarui
            try {
                $objWriter = IOFactory::createWriter($document, 'Word2007');
                $objWriter->save($newDocPath);
            } catch (\Exception $e) {
                log_message('error', 'Error saving Word document: ' . $e->getMessage());
                return view('form', ['error' => 'Error saving Word document.']);
            }

            // Kirim dokumen Word yang telah diperbarui sebagai lampiran untuk diunduh
            return $this->response->download($newDocPath, null);
        }
    }
}
