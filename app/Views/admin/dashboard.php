<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('styles') ?>
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid px-0">
        <!-- REKAP JUMLAH DATA -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Siswa -->
            <div class="card card-stats mb-0">
                <div class="card-header card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="text-right">
                        <p class="card-category">Jumlah siswa</p>
                        <h3 class="card-title"><?= count($siswa); ?></h3>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-primary">check_circle</i>
                        <a href="<?= base_url('admin/siswa'); ?>" class="text-secondary hover:text-primary transition-colors">Lihat detail terdaftar</a>
                    </div>
                </div>
            </div>
            
            <!-- Guru -->
            <div class="card card-stats mb-0">
                <div class="card-header card-header-success">
                    <div class="card-icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="text-right">
                        <p class="card-category">Jumlah guru</p>
                        <h3 class="card-title"><?= count($guru); ?></h3>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-success">check_circle</i>
                        <a href="<?= base_url('admin/guru'); ?>" class="text-secondary hover:text-success transition-colors">Lihat detail terdaftar</a>
                    </div>
                </div>
            </div>
            
            <!-- Kelas -->
            <div class="card card-stats mb-0">
                <div class="card-header card-header-info">
                    <div class="card-icon">
                        <i class="material-icons">meeting_room</i>
                    </div>
                    <div class="text-right">
                        <p class="card-category">Jumlah kelas</p>
                        <h3 class="card-title"><?= count($kelas); ?></h3>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">home</i>
                        <a href="<?= base_url('admin/kelas'); ?>" class="text-secondary hover:text-info transition-colors"><?= $generalSettings->school_name; ?></a>
                    </div>
                </div>
            </div>
            
            <!-- Petugas -->
            <div class="card card-stats mb-0">
                <div class="card-header card-header-danger">
                    <div class="card-icon">
                        <i class="material-icons">admin_panel_settings</i>
                    </div>
                    <div class="text-right">
                        <p class="card-category">Jumlah petugas</p>
                        <h3 class="card-title"><?= count($petugas); ?></h3>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-danger">manage_accounts</i>
                        <a href="<?= base_url('admin/petugas'); ?>" class="text-secondary hover:text-danger transition-colors">Admin & Staf</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- STATS SISWA HARI INI -->
            <div class="card mb-0 flex flex-col">
                <div class="card-header flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h4 class="card-title" id="titleSiswaStats">Absensi Siswa Hari Ini</h4>
                        <p class="card-category"><?= $dateNow; ?></p>
                    </div>
                    <!-- FILTER KELAS -->
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div id="filterLoader" style="display: none;">
                            <div class="animate-spin h-5 w-5 border-2 border-primary border-t-transparent rounded-full"></div>
                        </div>
                        <select name="id_kelas" id="filterKelas" class="form-select min-w-[200px]">
                            <option value="">-- Semua Kelas (<?= count($siswa) ?> siswa) --</option>
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>" data-kelas="<?= $k['kelas'] ?>">
                                    <?= $k['kelas'] ?> (<?= $k['jumlah_siswa'] ?? 0 ?> siswa)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-body flex-1" id="siswaStatsContainer">
                    <?= view('admin/_dashboard_siswa_stats', [
                        'hadir' => $jumlahKehadiranSiswa['hadir'],
                        'sakit' => $jumlahKehadiranSiswa['sakit'],
                        'izin' => $jumlahKehadiranSiswa['izin'],
                        'alfa' => $jumlahKehadiranSiswa['alfa'],
                        'totalSiswa' => $totalSiswa
                    ]) ?>
                </div>
            </div>
            
            <!-- STATS GURU HARI INI -->
            <div class="card mb-0 flex flex-col">
                <div class="card-header">
                    <h4 class="card-title">Absensi Guru Hari Ini</h4>
                    <p class="card-category"><?= $dateNow; ?></p>
                </div>
                <div class="card-body flex-1 flex items-center justify-center">
                    <div class="row text-center flex-nowrap w-full">
                        <div class="col-2">
                            <h5 class="text-success text-nowrap"><b>Hadir</b></h5>
                            <h4 class="text-nowrap"><?= $jumlahKehadiranGuru['hadir']; ?></h4>
                        </div>
                        <div class="col-2">
                            <h5 class="text-warning text-nowrap"><b>Sakit</b></h5>
                            <h4 class="text-nowrap"><?= $jumlahKehadiranGuru['sakit']; ?></h4>
                        </div>
                        <div class="col-2">
                            <h5 class="text-info text-nowrap"><b>Izin</b></h5>
                            <h4 class="text-nowrap"><?= $jumlahKehadiranGuru['izin']; ?></h4>
                        </div>
                        <div class="col-2">
                            <h5 class="text-danger text-nowrap"><b>Alfa</b></h5>
                            <h4 class="text-nowrap"><?= $jumlahKehadiranGuru['alfa']; ?></h4>
                        </div>
                        <div class="col-1">
                            <div class="border-right mx-auto h-100" style="width: 0;"></div>
                        </div>
                        <div class="col-2 col-sm-3">
                            <h5 class="text-primary text-nowrap"><b>Total</b></h5>
                            <h4 class="text-nowrap"><?= $totalGuru; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- CHART SISWA -->
            <div class="card mb-0 flex flex-col">
                <div class="card-header">
                    <h4 class="card-title" id="titleSiswaChart">Tren Kehadiran Siswa</h4>
                    <p class="card-category">Statistik kehadiran 7 hari terakhir</p>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="kehadiranSiswa"></canvas>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-primary">checklist</i> 
                        <a class="text-primary font-medium hover:underline" href="<?= base_url('admin/absen-siswa'); ?>">Lihat rekap absensi lengkap</a>
                    </div>
                </div>
            </div>
            
            <!-- CHART GURU -->
            <div class="card mb-0 flex flex-col">
                <div class="card-header">
                    <h4 class="card-title">Tren Kehadiran Guru</h4>
                    <p class="card-category">Statistik kehadiran 7 hari terakhir</p>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="kehadiranGuru"></canvas>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-success">checklist</i> 
                        <a class="text-success font-medium hover:underline" href="<?= base_url('admin/absen-guru'); ?>">Lihat rekap absensi lengkap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Chart.js CDN -->
<script src="<?= base_url('assets/js/plugins/chartjs/chart.umd.min.js') ?>"></script>
<script>
    let kehadiranSiswaChart;
    let kehadiranGuruChart;

    const chartLabels = <?= json_encode($dateRange) ?>;

    const chartColors = {
        hadir: { border: '#10B981', bg: 'rgba(16, 185, 129, 0.8)' },
        sakit: { border: '#F59E0B', bg: 'rgba(245, 158, 11, 0.8)' },
        izin:  { border: '#3B82F6', bg: 'rgba(59, 130, 246, 0.8)' },
        alfa:  { border: '#EF4444', bg: 'rgba(239, 68, 68, 0.8)' }
    };

    function createChartConfig(data) {
        return {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Hadir',
                        data: data.hadir,
                        backgroundColor: chartColors.hadir.bg,
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Sakit',
                        data: data.sakit,
                        backgroundColor: chartColors.sakit.bg,
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Izin',
                        data: data.izin,
                        backgroundColor: chartColors.izin.bg,
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Alfa',
                        data: data.alfa,
                        backgroundColor: chartColors.alfa.bg,
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 24,
                            font: { family: "'Inter', sans-serif", size: 12 }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: { family: "'Inter', sans-serif", size: 14, weight: '600' },
                        bodyFont: { family: "'Inter', sans-serif", size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' orang';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                if (Number.isInteger(value)) return value;
                            },
                            font: { family: "'Inter', sans-serif" }
                        },
                        grid: { color: 'rgba(0, 0, 0, 0.04)', drawBorder: false }
                    },
                    x: {
                        stacked: false,
                        grid: { display: false },
                        ticks: { font: { family: "'Inter', sans-serif" } }
                    }
                }
            }
        };
    }

    function updateSiswaChart(newData) {
        if (kehadiranSiswaChart) {
            kehadiranSiswaChart.data.datasets[0].data = newData.hadir;
            kehadiranSiswaChart.data.datasets[1].data = newData.sakit;
            kehadiranSiswaChart.data.datasets[2].data = newData.izin;
            kehadiranSiswaChart.data.datasets[3].data = newData.alfa;
            kehadiranSiswaChart.update('active');
        }
    }

    function initDashboardPageCharts() {
        const siswaCtx = document.getElementById('kehadiranSiswa');
        if (siswaCtx) {
            const dataSiswa = {
                hadir: <?= json_encode($grafikKehadiranSiswa['hadir']) ?>,
                sakit: <?= json_encode($grafikKehadiranSiswa['sakit']) ?>,
                izin: <?= json_encode($grafikKehadiranSiswa['izin']) ?>,
                alfa: <?= json_encode($grafikKehadiranSiswa['alfa']) ?>
            };
            kehadiranSiswaChart = new Chart(siswaCtx, createChartConfig(dataSiswa));
        }

        const guruCtx = document.getElementById('kehadiranGuru');
        if (guruCtx) {
            const dataGuru = {
                hadir: <?= json_encode($grafikKehadiranGuru['hadir']) ?>,
                sakit: <?= json_encode($grafikKehadiranGuru['sakit']) ?>,
                izin: <?= json_encode($grafikKehadiranGuru['izin']) ?>,
                alfa: <?= json_encode($grafikKehadiranGuru['alfa']) ?>
            };
            kehadiranGuruChart = new Chart(guruCtx, createChartConfig(dataGuru));
        }
    }

    $(document).ready(function () {
        initDashboardPageCharts();

        $('#filterKelas').on('change', function () {
            const idKelas = $(this).val();
            const loader = $('#filterLoader');

            loader.show();

            $.ajax({
                url: '<?= base_url('admin/dashboard/filter-data') ?>',
                type: 'POST',
                data: setAjaxData({ id_kelas: idKelas }),
                success: function (response) {
                    const obj = JSON.parse(response);
                    if (obj.result == 1) {
                        $('#siswaStatsContainer').html(obj.htmlContent);
                        updateSiswaChart(obj.chartData);
                    }
                },
                error: function (xhr, status, thrown) {
                    console.error(thrown);
                },
                complete: function () {
                    loader.hide();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>