@extends('layouts.app')

@section('title', 'Data Mahasiswa - Telkom University Style')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">DATA MAHASISWA</h1>
        <p class="text-slate-600 font-semibold text-sm">Kelola &amp; Cari Data Mahasiswa Terintegrasi</p>
    </div>
    <a href="{{ route('mahasiswa.create') }}"
       class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded-2xl font-bold jelly-hover jelly-click shadow-lg flex items-center justify-center gap-2">
        <span aria-hidden="true">+</span> Tambah Mahasiswa
    </a>
</div>

<div id="react-mahasiswa-root"
     data-mahasiswas="{{ json_encode($mahasiswas) }}"
     data-prodis="{{ json_encode($prodis) }}"
     data-edit-route="{{ route('mahasiswa.edit', ':id') }}"
     data-destroy-route="{{ route('mahasiswa.destroy', ':id') }}"
     data-csrf="{{ csrf_token() }}">
</div>
@endsection

@push('scripts')
<script type="text/babel">
    const rootEl = document.getElementById('react-mahasiswa-root');
    const initialMahasiswas = JSON.parse(rootEl.dataset.mahasiswas || '[]');
    const prodis = JSON.parse(rootEl.dataset.prodis || '[]');
    const routes = {
        edit: rootEl.dataset.editRoute,
        destroy: rootEl.dataset.destroyRoute,
        csrf: rootEl.dataset.csrf,
    };

    const MahasiswaTableManager = () => {
        const [searchQuery, setSearchQuery] = React.useState('');
        const [debouncedQuery, setDebouncedQuery] = React.useState('');
        const [selectedProdi, setSelectedProdi] = React.useState('');
        const [sortConfig, setSortConfig] = React.useState({ key: 'nama', direction: 'asc' });

        React.useEffect(() => {
            const timeoutId = window.setTimeout(() => setDebouncedQuery(searchQuery), 300);
            return () => window.clearTimeout(timeoutId);
        }, [searchQuery]);

        const handleSort = (key) => {
            setSortConfig((current) => ({
                key,
                direction: current.key === key && current.direction === 'asc' ? 'desc' : 'asc',
            }));
        };

        const sortIndicator = (key) => {
            if (sortConfig.key !== key) return '↕';
            return sortConfig.direction === 'asc' ? '▲' : '▼';
        };

        const processedMahasiswas = React.useMemo(() => {
            const normalizedQuery = debouncedQuery.trim().toLocaleLowerCase();
            const result = initialMahasiswas.filter((student) => {
                const matchQuery = String(student.nama || '').toLocaleLowerCase().includes(normalizedQuery)
                    || String(student.nim || '').toLocaleLowerCase().includes(normalizedQuery);
                const matchProdi = selectedProdi === ''
                    || String(student.program_studi_id) === String(selectedProdi);

                return matchQuery && matchProdi;
            });

            result.sort((studentA, studentB) => {
                const valueFor = (student) => {
                    if (sortConfig.key === 'prodi') {
                        return student.program_studi?.nama_prodi || '';
                    }
                    return student[sortConfig.key] || '';
                };
                const comparison = String(valueFor(studentA)).localeCompare(
                    String(valueFor(studentB)),
                    'id',
                    { numeric: true, sensitivity: 'base' }
                );

                return sortConfig.direction === 'asc' ? comparison : -comparison;
            });

            return result;
        }, [debouncedQuery, selectedProdi, sortConfig]);

        return (
            <div className="space-y-6">
                <div className="telu-glass rounded-3xl p-4 md:p-6 shadow-xl flex flex-col md:flex-row gap-4 justify-between items-center border-l-4 border-red-700">
                    <div className="relative w-full md:w-1/2">
                        <label htmlFor="mahasiswa-search" className="sr-only">Cari nama atau NIM</label>
                        <span aria-hidden="true" className="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">🔍</span>
                        <input
                            id="mahasiswa-search"
                            type="text"
                            placeholder="Cari Nama atau NIM..."
                            value={searchQuery}
                            onChange={(event) => setSearchQuery(event.target.value)}
                            className="w-full bg-white/70 border border-slate-200 focus:border-red-600 rounded-2xl pl-11 pr-10 py-3 text-slate-900 font-bold placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600/30 transition-all"
                        />
                        {searchQuery && (
                            <button
                                type="button"
                                onClick={() => setSearchQuery('')}
                                aria-label="Hapus pencarian"
                                className="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-700 font-bold"
                            >
                                ✕
                            </button>
                        )}
                    </div>

                    <div className="w-full md:w-1/3">
                        <label htmlFor="prodi-filter" className="sr-only">Filter Program Studi</label>
                        <select
                            id="prodi-filter"
                            value={selectedProdi}
                            onChange={(event) => setSelectedProdi(event.target.value)}
                            className="w-full bg-white/70 border border-slate-200 focus:border-red-600 rounded-2xl px-4 py-3 text-slate-900 font-bold focus:outline-none focus:ring-2 focus:ring-red-600/30 transition-all cursor-pointer"
                        >
                            <option value="">-- Semua Program Studi --</option>
                            {prodis.map((prodi) => (
                                <option key={prodi.id} value={prodi.id} className="text-slate-900 bg-white">
                                    {prodi.nama_prodi}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>

                <div className="flex justify-between items-center px-2 text-sm font-bold text-slate-600">
                    <span>
                        Menampilkan <strong className="text-red-700">{processedMahasiswas.length}</strong> dari {initialMahasiswas.length} mahasiswa
                    </span>
                    {(debouncedQuery || selectedProdi) && (
                        <button
                            type="button"
                            onClick={() => {
                                setSearchQuery('');
                                setSelectedProdi('');
                            }}
                            className="text-xs text-red-600 hover:underline font-bold"
                        >
                            Reset Filter
                        </button>
                    )}
                </div>

                <div className="table-wrap telu-glass rounded-3xl shadow-xl">
                    <table className="data-table w-full text-left border-collapse">
                        <thead>
                            <tr className="telu-table-head select-none">
                                <th>No</th>
                                <th aria-sort={sortConfig.key === 'nim' ? (sortConfig.direction === 'asc' ? 'ascending' : 'descending') : 'none'}>
                                    <button type="button" className="sort-button" onClick={() => handleSort('nim')}>
                                        NIM <span aria-hidden="true">{sortIndicator('nim')}</span>
                                    </button>
                                </th>
                                <th aria-sort={sortConfig.key === 'nama' ? (sortConfig.direction === 'asc' ? 'ascending' : 'descending') : 'none'}>
                                    <button type="button" className="sort-button" onClick={() => handleSort('nama')}>
                                        Nama Mahasiswa <span aria-hidden="true">{sortIndicator('nama')}</span>
                                    </button>
                                </th>
                                <th aria-sort={sortConfig.key === 'prodi' ? (sortConfig.direction === 'asc' ? 'ascending' : 'descending') : 'none'}>
                                    <button type="button" className="sort-button" onClick={() => handleSort('prodi')}>
                                        Program Studi <span aria-hidden="true">{sortIndicator('prodi')}</span>
                                    </button>
                                </th>
                                <th className="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {processedMahasiswas.length > 0 ? (
                                processedMahasiswas.map((student, index) => {
                                    const editUrl = routes.edit.replace(':id', student.id);
                                    const destroyUrl = routes.destroy.replace(':id', student.id);

                                    return (
                                        <tr key={student.id} className="transition-colors duration-200">
                                            <td className="font-bold text-slate-700">{index + 1}</td>
                                            <td className="font-bold">
                                                <span className="bg-slate-900 text-red-400 px-3 py-1 rounded-xl text-xs font-mono">
                                                    {student.nim}
                                                </span>
                                            </td>
                                            <td className="font-bold text-slate-900 text-base">{student.nama}</td>
                                            <td className="font-bold">
                                                <span className="bg-red-100 text-red-800 px-3 py-1.5 rounded-xl text-xs border border-red-200">
                                                    {student.program_studi ? student.program_studi.nama_prodi : 'Tanpa Prodi'}
                                                </span>
                                            </td>
                                            <td className="text-center">
                                                <a href={editUrl} className="inline-block bg-amber-500 text-white px-4 py-1.5 rounded-xl font-bold text-xs jelly-hover jelly-click shadow">Edit</a>
                                                <form action={destroyUrl} method="POST" className="inline-block">
                                                    <input type="hidden" name="_token" value={routes.csrf} />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button
                                                        type="submit"
                                                        onClick={(event) => {
                                                            if (!confirm('Hapus data ini?')) event.preventDefault();
                                                        }}
                                                        className="bg-red-600 text-white px-4 py-1.5 rounded-xl font-bold text-xs jelly-hover jelly-click shadow"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    );
                                })
                            ) : (
                                <tr>
                                    <td colSpan="5" className="empty-state">
                                        <div className="flex flex-col items-center justify-center gap-2">
                                            <span className="text-4xl" aria-hidden="true">🔍</span>
                                            <span>{initialMahasiswas.length === 0 ? 'Belum ada data mahasiswa terdaftar.' : 'Data mahasiswa tidak ditemukan.'}</span>
                                        </div>
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        );
    };

    const root = ReactDOM.createRoot(rootEl);
    root.render(<MahasiswaTableManager />);
</script>
@endpush