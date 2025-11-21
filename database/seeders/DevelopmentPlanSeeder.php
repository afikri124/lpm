<?php

namespace Database\Seeders;

use App\Models\DevelopmentPlan;
use Illuminate\Database\Seeder;

class DevelopmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '2020/2021' => [
                'Jumlah Mahasiswa' => [
                    ['uraian' => 'Jumlah Mahasiswa di JGU', 'rencana' => 1000, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kualitas Pendidikan' => [
                    ['uraian' => 'Akreditasi Institusi', 'rencana' => 'C/Baik', 'tercapai' => null, 'is_numeric' => false],
                    ['uraian' => 'Akreditasi Prodi B/Baik Sekali', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Akreditasi Prodi A/Unggul', 'rencana' => 0, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Hubungan Industri' => [
                    ['uraian' => 'Kegiatan Tri darma JGU bersama Industri', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kewirausahaan' => [
                    ['uraian' => 'Kegiatan terkait kewirausahaan bersama alumni dan Industri', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Internasionalisasi' => [
                    ['uraian' => 'Kegiatan tridarma bertaraf internasional', 'rencana' => 3, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Riset' => [
                    ['uraian' => 'Publikasi Ilmiah Internasional terindeks scopus', 'rencana' => 20, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Publikasi Ilmiah Nasional terindeks Sinta', 'rencana' => 25, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengalaman belajar' => [
                    ['uraian' => 'Kompetisi yang diikuti oleh mahasiswa', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Kegiatan pengabdian masyarakat yang melibatkan mahasiswa', 'rencana' => 3, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengembangan teknologi dan informasi kampus' => [
                    ['uraian' => 'Aplikasi penunjang terlaksananya tri darma perguruan tinggi', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Keberlanjutan' => [
                    ['uraian' => 'Kegiatan terkait SDG', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Reputasi dan Branding' => [
                    ['uraian' => 'Jumlah video/poster terkait Profil JGU & Prodi pada platform social media', 'rencana' => 60, 'tercapai' => 9, 'is_numeric' => true]
                ]
            ],
            '2021/2022' => [
                'Jumlah Mahasiswa' => [
                    ['uraian' => 'Jumlah Mahasiswa di JGU', 'rencana' => 1250, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kualitas Pendidikan' => [
                    ['uraian' => 'Akreditasi Institusi', 'rencana' => 'C/Baik', 'tercapai' => null, 'is_numeric' => false],
                    ['uraian' => 'Akreditasi Prodi B/Baik Sekali', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Akreditasi Prodi A/Unggul', 'rencana' => 0, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Hubungan Industri' => [
                    ['uraian' => 'Kegiatan Tri darma JGU bersama Industri', 'rencana' => 12, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kewirausahaan' => [
                    ['uraian' => 'Kegiatan terkait kewirausahaan bersama alumni dan Industri', 'rencana' => 4, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Internasionalisasi' => [
                    ['uraian' => 'Kegiatan tridarma bertaraf internasional', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Riset' => [
                    ['uraian' => 'Publikasi Ilmiah Internasional terindeks scopus', 'rencana' => 30, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Publikasi Ilmiah Nasional terindeks Sinta', 'rencana' => 30, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengalaman belajar' => [
                    ['uraian' => 'Kompetisi yang diikuti oleh mahasiswa', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Kegiatan pengabdian masyarakat yang melibatkan mahasiswa', 'rencana' => 8, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengembangan teknologi dan informasi kampus' => [
                    ['uraian' => 'Aplikasi penunjang terlaksananya tri darma perguruan tinggi', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Keberlanjutan' => [
                    ['uraian' => 'Kegiatan terkait SDG', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Reputasi dan Branding' => [
                    ['uraian' => 'Jumlah video/poster terkait Profil JGU & Prodi pada platform social media', 'rencana' => 70, 'tercapai' => 9, 'is_numeric' => true]
                ]
            ],
            '2022/2023' => [
                'Jumlah Mahasiswa' => [
                    ['uraian' => 'Jumlah Mahasiswa di JGU', 'rencana' => 1500, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kualitas Pendidikan' => [
                    ['uraian' => 'Akreditasi Institusi', 'rencana' => 'B/Baik Sekali', 'tercapai' => null, 'is_numeric' => false],
                    ['uraian' => 'Akreditasi Prodi B/Baik Sekali', 'rencana' => 5, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Akreditasi Prodi A/Unggul', 'rencana' => 0, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Hubungan Industri' => [
                    ['uraian' => 'Kegiatan Tri darma JGU bersama Industri', 'rencana' => 18, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kewirausahaan' => [
                    ['uraian' => 'Kegiatan terkait kewirausahaan bersama alumni dan Industri', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Internasionalisasi' => [
                    ['uraian' => 'Kegiatan tridarma bertaraf internasional', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Riset' => [
                    ['uraian' => 'Publikasi Ilmiah Internasional terindeks scopus', 'rencana' => 40, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Publikasi Ilmiah Nasional terindeks Sinta', 'rencana' => 80, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengalaman belajar' => [
                    ['uraian' => 'Kompetisi yang diikuti oleh mahasiswa', 'rencana' => 15, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Kegiatan pengabdian masyarakat yang melibatkan mahasiswa', 'rencana' => 16, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengembangan teknologi dan informasi kampus' => [
                    ['uraian' => 'Aplikasi penunjang terlaksananya tri darma perguruan tinggi', 'rencana' => 15, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Keberlanjutan' => [
                    ['uraian' => 'Kegiatan terkait SDG', 'rencana' => 8, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Reputasi dan Branding' => [
                    ['uraian' => 'Jumlah video/poster terkait Profil JGU & Prodi pada platform social media', 'rencana' => 80, 'tercapai' => 9, 'is_numeric' => true]
                ]
            ],
            '2023/2024' => [
                'Jumlah Mahasiswa' => [
                    ['uraian' => 'Jumlah Mahasiswa di JGU', 'rencana' => 1750, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kualitas Pendidikan' => [
                    ['uraian' => 'Akreditasi Institusi', 'rencana' => 'B/Baik Sekali', 'tercapai' => null, 'is_numeric' => false],
                    ['uraian' => 'Akreditasi Prodi B/Baik Sekali', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Akreditasi Prodi A/Unggul', 'rencana' => 1, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Hubungan Industri' => [
                    ['uraian' => 'Kegiatan Tri darma JGU bersama Industri', 'rencana' => 20, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kewirausahaan' => [
                    ['uraian' => 'Kegiatan terkait kewirausahaan bersama alumni dan Industri', 'rencana' => 8, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Internasionalisasi' => [
                    ['uraian' => 'Kegiatan tridarma bertaraf internasional', 'rencana' => 14, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Riset' => [
                    ['uraian' => 'Publikasi Ilmiah Internasional terindeks scopus', 'rencana' => 50, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Publikasi Ilmiah Nasional terindeks Sinta', 'rencana' => 100, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengalaman belajar' => [
                    ['uraian' => 'Kompetisi yang diikuti oleh mahasiswa', 'rencana' => 20, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Kegiatan pengabdian masyarakat yang melibatkan mahasiswa', 'rencana' => 20, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengembangan teknologi dan informasi kampus' => [
                    ['uraian' => 'Aplikasi penunjang terlaksananya tri darma perguruan tinggi', 'rencana' => 20, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Keberlanjutan' => [
                    ['uraian' => 'Kegiatan terkait SDG', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Reputasi dan Branding' => [
                    ['uraian' => 'Jumlah video/poster terkait Profil JGU & Prodi pada platform social media', 'rencana' => 90, 'tercapai' => 9, 'is_numeric' => true]
                ]
            ],
            '2024/2025' => [
                'Jumlah Mahasiswa' => [
                    ['uraian' => 'Jumlah Mahasiswa di JGU', 'rencana' => 2000, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kualitas Pendidikan' => [
                    ['uraian' => 'Akreditasi Institusi', 'rencana' => 'B/Baik Sekali', 'tercapai' => null, 'is_numeric' => false],
                    ['uraian' => 'Akreditasi Prodi B/Baik Sekali', 'rencana' => 6, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Akreditasi Prodi A/Unggul', 'rencana' => 2, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Hubungan Industri' => [
                    ['uraian' => 'Kegiatan Tri darma JGU bersama Industri', 'rencana' => 24, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Kewirausahaan' => [
                    ['uraian' => 'Kegiatan terkait kewirausahaan bersama alumni dan Industri', 'rencana' => 10, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Internasionalisasi' => [
                    ['uraian' => 'Kegiatan tridarma bertaraf internasional', 'rencana' => 18, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Riset' => [
                    ['uraian' => 'Publikasi Ilmiah Internasional terindeks scopus', 'rencana' => 60, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Publikasi Ilmiah Nasional terindeks Sinta', 'rencana' => 150, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengalaman belajar' => [
                    ['uraian' => 'Kompetisi yang diikuti oleh mahasiswa', 'rencana' => 24, 'tercapai' => 9, 'is_numeric' => true],
                    ['uraian' => 'Kegiatan pengabdian masyarakat yang melibatkan mahasiswa', 'rencana' => 26, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Pengembangan teknologi dan informasi kampus' => [
                    ['uraian' => 'Aplikasi penunjang terlaksananya tri darma perguruan tinggi', 'rencana' => 25, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Keberlanjutan' => [
                    ['uraian' => 'Kegiatan terkait SDG', 'rencana' => 12, 'tercapai' => 9, 'is_numeric' => true]
                ],
                'Reputasi dan Branding' => [
                    ['uraian' => 'Jumlah video/poster terkait Profil JGU & Prodi pada platform social media', 'rencana' => 100, 'tercapai' => 9, 'is_numeric' => true]
                ]
            ]
        ];

        $sortOrder = 0;
        foreach ($data as $year => $priorities) {
            foreach ($priorities as $priority => $items) {
                foreach ($items as $index => $item) {
                    DevelopmentPlan::create([
                        'year' => $year,
                        'priority' => $priority,
                        'uraian' => $item['uraian'],
                        'rencana' => is_numeric($item['rencana']) ? (string)$item['rencana'] : $item['rencana'],
                        'tercapai' => $item['tercapai'],
                        'is_numeric' => $item['is_numeric'],
                        'sort_order' => $sortOrder++,
                        'link' => null
                    ]);
                }
            }
        }
    }
}
