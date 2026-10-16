@extends('layouts.app')

@section('title', 'Dashboard - Sistem Ekstrakurikuler')

@section('content')
    <div id="react-dashboard-root"
         data-prodi="{{ $totalProdi }}"
         data-mk="{{ $totalMataKuliah }}"
         data-mhs="{{ $totalMahasiswa }}"
         data-route-mahasiswa="{{ route('mahasiswa.index') }}"
         data-route-prodi="{{ route('prodi.index') }}"
         data-route-mk="{{ route('mata-kuliah.index') }}"
         data-route-tambah-mahasiswa="{{ route('mahasiswa.create') }}">
    </div>
@endsection

@push('scripts')
<script type="text/babel">
    // Komponen Partikel Interaktif yang Bereaksi Terhadap Mouse (Dioptimalkan agar ringan)
    const InteractiveParticles = () => {
        const canvasRef = React.useRef(null);

        React.useEffect(() => {
            const canvas = canvasRef.current;
            const parent = canvas?.parentElement;
            const context = canvas?.getContext('2d');
            if (!canvas || !parent || !context) return undefined;

            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const mouse = { x: null, y: null, radius: 100 };
            const particles = [];
            let width = 0;
            let height = 0;
            let pixelRatio = 1;
            let animationFrameId = 0;

            const createParticles = () => {
                particles.length = 0;
                // Jumlah partikel dibatasi proporsional agar tidak berat
                const count = Math.min(45, Math.max(10, Math.floor((width * height) / 15000)));
                for (let index = 0; index < count; index++) {
                    const x = Math.random() * width;
                    const y = Math.random() * height;
                    particles.push({
                        x,
                        y,
                        anchorX: x,
                        anchorY: y,
                        phase: Math.random() * Math.PI * 2,
                        size: Math.random() * 2 + 1.5,
                        density: Math.random() * 4 + 2,
                        velocityX: (Math.random() - 0.5) * 0.2,
                        velocityY: (Math.random() - 0.5) * 0.2,
                        color: Math.random() > 0.3 ? '185, 28, 28' : '127, 29, 29', // Nuansa merah tua/maroon
                        alpha: Math.random() * 0.3 + 0.2,
                    });
                }
            };

            const resizeCanvas = () => {
                const bounds = parent.getBoundingClientRect();
                width = bounds.width;
                height = bounds.height;
                pixelRatio = Math.min(window.devicePixelRatio || 1, 2);
                canvas.width = Math.round(width * pixelRatio);
                canvas.height = Math.round(height * pixelRatio);
                context.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
                createParticles();
            };

            const drawParticles = (time) => {
                context.clearRect(0, 0, width, height);
                const elapsed = time * 0.001;

                for (const particle of particles) {
                    // Gerakan mengapung alami
                    const floatX = Math.sin(elapsed * 0.5 + particle.phase) * 4;
                    const floatY = Math.cos(elapsed * 0.4 + particle.phase) * 4;
                    particle.velocityX += (particle.anchorX + floatX - particle.x) * 0.003;
                    particle.velocityY += (particle.anchorY + floatY - particle.y) * 0.003;

                    // Reaksi interaktif terhadap kursor mouse
                    if (mouse.x !== null && mouse.y !== null) {
                        const deltaX = particle.x - mouse.x;
                        const deltaY = particle.y - mouse.y;
                        const distance = Math.hypot(deltaX, deltaY);
                        if (distance < mouse.radius && distance > 0.01) {
                            const force = (mouse.radius - distance) / mouse.radius;
                            particle.velocityX += (deltaX / distance) * force * particle.density * 0.06;
                            particle.velocityY += (deltaY / distance) * force * particle.density * 0.06;
                        }
                    }

                    particle.velocityX *= 0.95;
                    particle.velocityY *= 0.95;
                    particle.x += particle.velocityX;
                    particle.y += particle.velocityY;

                    // Batas area canvas
                    particle.x = Math.max(2, Math.min(width - 2, particle.x));
                    particle.y = Math.max(2, Math.min(height - 2, particle.y));
                }

                // Gambar garis antar partikel jika berdekatan
                for (let first = 0; first < particles.length; first++) {
                    const particle = particles[first];
                    for (let second = first + 1; second < particles.length; second++) {
                        const other = particles[second];
                        const distance = Math.hypot(particle.x - other.x, particle.y - other.y);
                        if (distance < 85) {
                            context.beginPath();
                            context.strokeStyle = `rgba(${particle.color}, ${0.15 * (1 - distance / 85)})`;
                            context.lineWidth = 0.6;
                            context.moveTo(particle.x, particle.y);
                            context.lineTo(other.x, other.y);
                            context.stroke();
                        }
                    }
                }

                    // Gambar titik partikel
                for (const particle of particles) {
                    context.beginPath();
                    context.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                    context.fillStyle = `rgba(${particle.color}, ${particle.alpha})`;
                    context.fill();
                }
            };

            const animate = (time) => {
                drawParticles(time);
                animationFrameId = window.requestAnimationFrame(animate);
            };

            const handlePointerMove = (event) => {
                const bounds = canvas.getBoundingClientRect();
                mouse.x = event.clientX - bounds.left;
                mouse.y = event.clientY - bounds.top;
            };

            const handlePointerLeave = () => {
                mouse.x = null;
                mouse.y = null;
            };

            resizeCanvas();
            const resizeObserver = new ResizeObserver(resizeCanvas);
            resizeObserver.observe(parent);
            parent.addEventListener('pointermove', handlePointerMove, { passive: true });
            parent.addEventListener('pointerleave', handlePointerLeave);
            
            if (!reducedMotion) {
                animationFrameId = window.requestAnimationFrame(animate);
            }

            return () => {
                resizeObserver.disconnect();
                parent.removeEventListener('pointermove', handlePointerMove);
                parent.removeEventListener('pointerleave', handlePointerLeave);
                window.cancelAnimationFrame(animationFrameId);
            };
        }, []);

        return <canvas ref={canvasRef} aria-hidden="true" className="absolute inset-0 z-0 h-full w-full rounded-3xl pointer-events-none" />;
    };

    const DashboardHero = ({ routes }) => (
        <section className="telu-glass relative mb-8 overflow-hidden rounded-3xl border-t-4 border-red-700 p-6 shadow-2xl md:p-10">
            <InteractiveParticles />
            <div className="relative z-10 max-w-3xl">
                <div className="mb-4 inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-100 px-3 py-1.5 text-xs font-extrabold text-red-800 shadow-sm backdrop-blur-md">
                    <span aria-hidden="true">🏆</span>
                    <span>Sistem Ekstrakurikuler Terpadu</span>
                </div>
                <h1 className="mb-4 text-3xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Selamat Datang di <span className="text-red-700">SIM Ekstrakurikuler</span>
                </h1>
                <p className="mb-6 text-base font-medium leading-relaxed text-slate-600 md:text-lg">
                    Platform manajemen terpadu untuk mengelola kegiatan Ekstrakurikuler, Pembina, dan Jadwal Kegiatan secara efisien dan modern.
                </p>
                <div className="relative z-10 flex flex-wrap items-center gap-4">
                    <a href={routes.mahasiswa} className="jelly-hover jelly-click flex items-center gap-2 rounded-2xl bg-red-700 px-6 py-3 text-sm font-extrabold text-white shadow-lg hover:bg-red-800 transition-all">
                        <span aria-hidden="true">👨‍🏫</span> Kelola Data Pembina
                    </a>
                    <a href={routes.tambahMahasiswa} className="telu-glass jelly-hover jelly-click flex items-center gap-2 rounded-2xl border border-slate-200 px-6 py-3 text-sm font-extrabold text-slate-800 hover:text-red-700 transition-all bg-white/60">
                        <span aria-hidden="true">+</span> Tambah Pembina Baru
                    </a>
                </div>
            </div>
        </section>
    );

    const StatCard = ({ title, count, icon, bgClass, href }) => (
        <a href={href} className="group block no-underline">
            <div className={`relative overflow-hidden rounded-3xl p-6 shadow-xl jelly-hover jelly-click transition-all duration-300 ${bgClass}`}>
                <div className="flex items-center justify-between">
                    <div>
                        <p className="mb-1 text-xs font-extrabold uppercase opacity-90">{title}</p>
                        <h3 className="text-4xl font-extrabold md:text-5xl">{count}</h3>
                    </div>
                    <span aria-hidden="true" className="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/20 text-3xl shadow-inner backdrop-blur-md group-hover:scale-110 transition-transform">{icon}</span>
                </div>
                <div className="mt-6 flex items-center gap-2 text-xs font-bold opacity-90 transition-transform group-hover:translate-x-1">
                    <span>Lihat Detail Data</span><span aria-hidden="true">→</span>
                </div>
            </div>
        </a>
    );

    const FeatureHighlights = () => {
        const features = [
            { icon: '🥇', title: 'Ekstrakurikuler Active', description: 'Pengelolaan data organisasi dan unit kegiatan siswa yang terstruktur.' },
            { icon: '⚡', title: 'Manajemen Real-Time', description: 'Cari, filter, dan urutkan data pembina serta kegiatan secara instan.' },
            { icon: '🛡️', title: 'Data Terintegrasi', description: 'Informasi pembina terhubung langsung dengan ekstrakurikuler yang didampingi.' },
        ];

        return (
            <section className="grid grid-cols-1 gap-6 md:grid-cols-3" aria-label="Fitur ekstrakurikuler">
                {features.map((feature) => (
                    <article key={feature.title} className="telu-glass rounded-3xl border border-white/60 p-6 shadow-lg jelly-hover transition-all">
                        <span aria-hidden="true" className="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-2xl text-red-700 shadow-inner">{feature.icon}</span>
                        <h3 className="mb-2 text-lg font-extrabold text-slate-900">{feature.title}</h3>
                        <p className="text-sm font-medium leading-relaxed text-slate-600">{feature.description}</p>
                    </article>
                ))}
            </section>
        );
    };

    const MainDashboard = () => {
        const rootEl = document.getElementById('react-dashboard-root');
        if (!rootEl) return null;

        const dashboardData = {
            totalProdi: Number(rootEl.dataset.prodi || 0),
            totalMk: Number(rootEl.dataset.mk || 0),
            totalMhs: Number(rootEl.dataset.mhs || 0),
            routes: {
                mahasiswa: rootEl.dataset.routeMahasiswa,
                prodi: rootEl.dataset.routeProdi,
                mk: rootEl.dataset.routeMk,
                tambahMahasiswa: rootEl.dataset.routeTambahMahasiswa,
            },
        };

        return (
            <div className="space-y-8">
                <DashboardHero routes={dashboardData.routes} />
                <section aria-labelledby="dashboard-stats-title">
                    <h2 id="dashboard-stats-title" className="mb-4 border-l-4 border-red-700 pl-3 text-xl font-extrabold text-slate-800">
                        Statistik Ekstrakurikuler
                    </h2>
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <StatCard title="Ekstrakurikuler" count={dashboardData.totalProdi} icon="🏆" bgClass="bg-gradient-to-br from-red-700 to-red-900 text-white shadow-red-900/20" href={dashboardData.routes.prodi} />
                        <StatCard title="Jadwal / Kegiatan" count={dashboardData.totalMk} icon="📅" bgClass="telu-glass border-2 border-red-100 text-red-700 bg-white/70 shadow-red-100/50" href={dashboardData.routes.mk} />
                        <StatCard title="Total Pembina" count={dashboardData.totalMhs} icon="👨‍🏫" bgClass="bg-gradient-to-br from-slate-900 to-red-950 text-white shadow-slate-900/20" href={dashboardData.routes.mahasiswa} />
                    </div>
                </section>
                <FeatureHighlights />
            </div>
        );
    };

    const rootElement = document.getElementById('react-dashboard-root');
    if (rootElement) {
        ReactDOM.createRoot(rootElement).render(<MainDashboard />);
    }
</script>
@endpush