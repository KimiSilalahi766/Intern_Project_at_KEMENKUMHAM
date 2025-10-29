<?php
namespace App\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;

class WordProcessor extends BaseController {

    public function index()
    {
        return view('form');
    }

    public function replace()
    {
        // Enable error logging
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        // Validation rules
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
            log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
            return view('form', [
                'validation' => $this->validator,
            ]);
        }

        // Path to template and output file
        $templatePath = WRITEPATH . 'filedox/laporanevaluasi.docx';
        $outputPath = WRITEPATH . 'filedox/update_laporanevaluasi.docx';

        // Log file paths
        log_message('info', 'Template path: ' . $templatePath);
        log_message('info', 'Output path: ' . $outputPath);

        // Check if template exists
        if (!file_exists($templatePath)) {
            log_message('error', 'Template file not found: ' . $templatePath);
            return view('form', ['error' => 'Template file tidak ditemukan di: ' . $templatePath]);
        }

        // Check if template is readable
        if (!is_readable($templatePath)) {
            log_message('error', 'Template file not readable: ' . $templatePath);
            return view('form', ['error' => 'Template file tidak bisa dibaca. Cek permission file.']);
        }

        // Check if output directory is writable
        $outputDir = dirname($outputPath);
        if (!is_writable($outputDir)) {
            log_message('error', 'Output directory not writable: ' . $outputDir);
            return view('form', ['error' => 'Folder output tidak bisa ditulis. Cek permission: ' . $outputDir]);
        }

        try {
            log_message('info', 'Loading template processor...');
            
            // Load template using TemplateProcessor
            $templateProcessor = new TemplateProcessor($templatePath);
            
            log_message('info', 'Template loaded successfully');

            // Replace text placeholders
            $templateProcessor->setValue('JUDUL', $this->request->getPost('judul'));
            $templateProcessor->setValue('Alamat', $this->request->getPost('alamat'));
            $templateProcessor->setValue('Telpon', $this->request->getPost('telpon'));
            $templateProcessor->setValue('manla', $this->request->getPost('manla'));
            $templateProcessor->setValue('relsu', $this->request->getPost('relsu'));
            $templateProcessor->setValue('NAMSAT', $this->request->getPost('namsat'));
            $templateProcessor->setValue('satker', $this->request->getPost('satker'));
            $templateProcessor->setValue('triwulan', $this->request->getPost('triwulan'));
            $templateProcessor->setValue('tahun', $this->request->getPost('tahun'));
            $templateProcessor->setValue('output', $this->request->getPost('output'));
            $templateProcessor->setValue('wulantri', $this->request->getPost('wulantri'));
            $templateProcessor->setValue('hunta', $this->request->getPost('hunta'));
            $templateProcessor->setValue('putout', $this->request->getPost('putout'));
            $templateProcessor->setValue('hambatan1', $this->request->getPost('hambatan1'));
            $templateProcessor->setValue('hambatan2', $this->request->getPost('hambatan2'));
            $templateProcessor->setValue('rencana1', $this->request->getPost('rencana1'));
            $templateProcessor->setValue('rencana2', $this->request->getPost('rencana2'));

            log_message('info', 'Text placeholders replaced');

            // Process and save uploaded images
            $gambar_gbremonev = $this->request->getFile('gambar_gbremonev');
            $gambar_gmbrsmart = $this->request->getFile('gambar_gmbrsmart');
            $gambar_gbrerformance = $this->request->getFile('gambar_gbrerformance');

            log_message('info', 'Processing images...');

            // Save images with unique names
            if ($gambar_gbremonev->isValid() && !$gambar_gbremonev->hasMoved()) {
                $gbremonevName = $gambar_gbremonev->getRandomName();
                $gambar_gbremonev->move(WRITEPATH . 'uploads', $gbremonevName);
                $imagePath1 = WRITEPATH . 'uploads/' . $gbremonevName;
                
                log_message('info', 'E-Monev image saved: ' . $imagePath1);
                
                // Replace image placeholder with actual image
                $templateProcessor->setImageValue('gbremonev', array(
                    'path' => $imagePath1,
                    'width' => 400,
                    'height' => 300,
                    'ratio' => false
                ));
                
                log_message('info', 'E-Monev placeholder replaced');
            }

            if ($gambar_gmbrsmart->isValid() && !$gambar_gmbrsmart->hasMoved()) {
                $gmbrsmartName = $gambar_gmbrsmart->getRandomName();
                $gambar_gmbrsmart->move(WRITEPATH . 'uploads', $gmbrsmartName);
                $imagePath2 = WRITEPATH . 'uploads/' . $gmbrsmartName;
                
                log_message('info', 'SMART image saved: ' . $imagePath2);
                
                // Replace image placeholder with actual image
                $templateProcessor->setImageValue('gmbrsmart', array(
                    'path' => $imagePath2,
                    'width' => 400,
                    'height' => 300,
                    'ratio' => false
                ));
                
                log_message('info', 'SMART placeholder replaced');
            }

            if ($gambar_gbrerformance->isValid() && !$gambar_gbrerformance->hasMoved()) {
                $gbrerformanceName = $gambar_gbrerformance->getRandomName();
                $gambar_gbrerformance->move(WRITEPATH . 'uploads', $gbrerformanceName);
                $imagePath3 = WRITEPATH . 'uploads/' . $gbrerformanceName;
                
                log_message('info', 'E-Performance image saved: ' . $imagePath3);
                
                // Replace image placeholder with actual image
                $templateProcessor->setImageValue('gbrerformance', array(
                    'path' => $imagePath3,
                    'width' => 400,
                    'height' => 300,
                    'ratio' => false
                ));
                
                log_message('info', 'E-Performance placeholder replaced');
            }

            log_message('info', 'Saving document to: ' . $outputPath);

            // Save the updated document
            $templateProcessor->saveAs($outputPath);
            
            // Verify file was created
            if (!file_exists($outputPath)) {
                log_message('error', 'Output file was not created: ' . $outputPath);
                return view('form', ['error' => 'File output tidak berhasil dibuat. Cek log untuk detail.']);
            }

            $fileSize = filesize($outputPath);
            log_message('info', 'Document saved successfully. Size: ' . $fileSize . ' bytes');

            // Generate unique filename for download
            $downloadName = 'Laporan_Evaluasi_' . date('Y-m-d_His') . '.docx';
            
            log_message('info', 'Starting download: ' . $downloadName);

            // Download the file
            return $this->response->download($outputPath, null)->setFileName($downloadName);

        } catch (\Exception $e) {
            log_message('error', 'Error processing Word document: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return view('form', ['error' => 'Terjadi kesalahan: ' . $e->getMessage() . '. Cek log di writable/logs/ untuk detail.']);
        }
    }
}
