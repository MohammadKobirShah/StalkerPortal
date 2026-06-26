<?php
require_once 'jitendraunatti.php';
global $SCARLET_WITCH;
if (!file_exists($DARK_SIDE . "/login.jitendraunatti")) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>STALKER PRO | <?php echo htmlspecialchars($SCARLET_WITCH['JITENDRA_UNIVERSE']['DEV_NAME']); ?></title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/GQCh1t2b/Screenshot-2026-04-13-at-3-50-15-PM.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Premium Shimmer Animation */
        .skeleton {
            position: relative;
            overflow: hidden;
            background-color: #0d1117;
            /* Dark background to match your theme */
        }

        .skeleton::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 0,
                    rgba(255, 255, 255, 0.03) 20%,
                    rgba(255, 255, 255, 0.07) 50%,
                    rgba(255, 255, 255, 0.03) 80%,
                    rgba(255, 255, 255, 0) 100%);
            animation: shimmer 2s infinite cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        body {
            background: #010409;
            color: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        /* Smooth Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3b82f6;
        }

        .glass-nav {
            background: rgba(13, 17, 23, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Animation Keyframes */
        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
                filter: blur(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        @keyframes gridFade {
            from {
                opacity: 0;
                filter: grayscale(1) blur(5px);
            }

            to {
                opacity: 1;
                filter: grayscale(0) blur(0);
            }
        }

        .channel-entrance {
            opacity: 0;
            animation: cardEntrance 0.6s cubic-bezier(0.2, 1, 0.2, 1) forwards;
        }

        .grid-fade-in {
            animation: gridFade 0.5s ease-out forwards;
        }

        /* Genre Adaptive Layout */
        .genre-container-wrapper {
            display: flex;
            overflow-x: auto;
            scrollbar-width: none;
            padding: 0.5rem 1rem;
            gap: 0.5rem;
        }

        .genre-container-wrapper::-webkit-scrollbar {
            display: none;
        }

        .genre-item {
            white-space: nowrap;
            padding: 0.6rem 1.2rem;
            color: #94a3b8;
            border-radius: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid transparent;
        }

        .genre-item.active {
            color: #fff;
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1);
        }

        @media (min-width: 1024px) {
            .genre-container-wrapper {
                flex-direction: column;
                position: sticky;
                top: 110px;
                height: calc(100vh - 150px);
                overflow-y: auto;
                padding: 0;
            }

            .genre-item {
                background: transparent;
                border: none;
                margin-bottom: 4px;
            }

            .genre-item:hover {
                background: rgba(255, 255, 255, 0.05);
            }
        }

        .channel-card {
            background: #0d1117;
            border-radius: 1.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.4s ease;
        }

        .channel-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .vault-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .vault-card:hover {
            background: rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .skeleton {
            background: linear-gradient(90deg, #0d1117 25%, #161b22 50%, #0d1117 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Ensure the grid doesn't squash cards */
        #channelGrid {
            grid-auto-rows: 1fr;
        }

        .channel-card img {
            /* This prevents the "stretched" look seen in your Gulf War logos */
            pointer-events: none;
            user-select: none;
        }

        /* Optional: If many logos have white backgrounds, this helps them blend */
        .channel-card img.relative {
            filter: brightness(0.9) contrast(1.1);
        }

        .channel-card:hover img.relative {
            filter: brightness(1.1) contrast(1.1);
        }

        /* Smooth out the container for the logo */
        .channel-card .aspect-square {
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }
    </style>
</head>

<body>

    <div id="portalModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/95 backdrop-blur-2xl animate-in fade-in">
        <div class="w-full max-w-xl rounded-[2.5rem] p-8 border border-white/10 bg-[#0d1117] shadow-2xl overflow-hidden">

            <div id="vaultListView">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-black text-white">Identity Vault</h2>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Select a stored handshake</p>
                    </div>
                    <button onclick="togglePortalModal(false)" class="p-2 text-slate-500 hover:text-white transition-colors"><i data-lucide="x"></i></button>
                </div>
                <div id="portalList" class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar"></div>
            </div>

            <div id="vaultDetailView" class="hidden animate-in slide-in-from-right-10">
                <button onclick="backToVaultList()" class="flex items-center gap-2 text-blue-400 text-[10px] font-black uppercase mb-6 hover:text-white transition-all">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Back to Vault
                </button>
                <div id="portalDetailContent" class="grid grid-cols-1 gap-3 bg-black/20 p-5 rounded-3xl border border-white/5"></div>
                <button id="activatePortalBtn" class="w-full mt-8 py-5 rounded-2xl bg-blue-600 text-white font-black uppercase tracking-widest hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/30">
                    Switch Identity Now
                </button>
            </div>

            <button onclick="togglePortalModal(false)" id="vaultCloseBtn" class="w-full mt-8 py-4 rounded-2xl bg-white/5 text-slate-500 font-bold hover:bg-white/10 transition-all">Dismiss</button>
        </div>
    </div>

    <nav class="glass-nav sticky top-0 z-[60] px-4 py-3 md:px-10">
        <div class="max-w-screen-2xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 group cursor-pointer" onclick="location.reload()">
                <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-12 transition-all">
                    <i data-lucide="zap" class="text-white w-5 h-5 fill-current"></i>
                </div>
                <h1 class="text-lg font-black uppercase hidden sm:block">STALKER <span class="text-blue-500 italic">PRO</span></h1>
            </div>

            <div class="flex-1 max-w-md hidden md:flex items-center bg-white/5 border border-white/5 p-1 rounded-2xl focus-within:border-blue-500/40 transition-all">
                <i data-lucide="search" class="w-4 h-4 ml-4 text-slate-500"></i>
                <input type="text" id="searchInput" placeholder="Find a channel..." class="w-full bg-transparent py-2 px-3 text-sm outline-none">
            </div>

            <div class="flex items-center gap-4">
                <!-- SCARLET_WITCH Dynamic Message Box -->
                <div class="hidden lg:block text-right font-bold text-xs">
                    <?php
                    global $SCARLET_WITCH;
                    if (isset($SCARLET_WITCH['message']) && is_array($SCARLET_WITCH['message'])) {
                        foreach ($SCARLET_WITCH['message'] as $msg) {
                            if (!empty($msg['message'])) {
                                $color = $msg['color'] ?? '#fff';
                                $op = $msg['tag_op'] ?? '<div>';
                                $cl = $msg['tag_c'] ?? '</div>';

                                echo $op . "<span style='color: $color;'>" . htmlspecialchars($msg['message']) . "</span>" . $cl;
                            }
                        }
                    }
                    ?>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="fetchSavedPortals()" class="p-3 bg-blue-600/10 text-blue-400 rounded-2xl border border-blue-500/20 hover:bg-blue-600 hover:text-white transition-all">
                        <i data-lucide="layers" class="w-5 h-5"></i>
                    </button>
                    <a href="playlist.php" class="p-3 bg-white/5 rounded-2xl border border-white/5 text-slate-400 hover:text-white transition-all">
                        <i data-lucide="download" class="w-5 h-5"></i>
                    </a>
                    <a href="login.php" class="p-3 bg-rose-500/10 rounded-2xl border border-rose-500/20 text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-3 md:hidden flex items-center bg-white/5 border border-white/5 p-1 rounded-xl">
            <i data-lucide="search" class="w-4 h-4 ml-3 text-slate-500"></i>
            <input type="text" id="mobileSearch" placeholder="Search channels..." class="w-full bg-transparent py-2 px-3 text-sm outline-none">
        </div>
        
        <!-- Mobile View for System Messages -->
        <div class="block lg:hidden mt-2 text-center text-[11px] font-medium">
            <?php
            if (isset($SCARLET_WITCH['message']) && is_array($SCARLET_WITCH['message'])) {
                foreach ($SCARLET_WITCH['message'] as $msg) {
                    if (!empty($msg['message'])) {
                        $color = $msg['color'] ?? '#fff';
                        $op = $msg['tag_op'] ?? '<div>';
                        $cl = $msg['tag_c'] ?? '</div>';

                        echo $op . "<span style='color: $color;'>" . htmlspecialchars($msg['message']) . "</span>" . $cl;
                    }
                }
            }
            ?>
        </div>
    </nav>

    <div class="lg:hidden mt-2 border-b border-white/5 pb-2">
        <div id="genreContainerMobile" class="genre-container-wrapper"></div>
    </div>

    <div class="max-w-[1800px] mx-auto mt-4 lg:mt-12 px-4 md:px-10 flex flex-col lg:flex-row gap-10">

        <aside class="hidden lg:block w-64 shrink-0">
            <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.4em] mb-6 px-4">Categories</h3>
            <div id="genreContainerDesktop" class="genre-container-wrapper"></div>
        </aside>

        <div class="flex-1">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 id="currentCategoryTitle" class="text-3xl font-black uppercase tracking-tighter">Recommended</h2>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-1">Showing <span id="channelCount" class="text-blue-500">0</span> channels</p>
                </div>
            </div>

            <div id="channelGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-8">
            </div>

            <div id="loadMoreTrigger" class="h-40 flex items-center justify-center w-full">
                <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin opacity-0" id="loaderDot"></div>
            </div>
        </div>
    </div>

    <script>
        let allChannels = [];
        let savedPortalsData = [];
        let currentGenre = 'all';
        let limit = 24;
        let offset = 0;

        lucide.createIcons();

        // FALLBACK GENERATOR
        const getFallback = (name) => {
            const colors = ['#3b82f6', '#8b5cf6', '#ef4444', '#10b981', '#f59e0b'];
            const color = colors[name.length % colors.length];
            const char = name.charAt(0).toUpperCase();
            return `data:image/svg+xml;base64,${btoa(`<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300"><rect width="300" height="300" fill="${color}" opacity="0.1"/><text x="50%" y="55%" font-family="Arial" font-weight="900" font-size="80" fill="${color}" text-anchor="middle" dominant-baseline="middle">${char}</text></svg>`)}`;
        };

        // --- VAULT & INSPECTOR LOGIC ---
        function togglePortalModal(s) {
            document.getElementById('portalModal').classList.toggle('hidden', !s);
            if (s) backToVaultList();
        }

        async function fetchSavedPortals() {
            togglePortalModal(true);
            const list = document.getElementById('portalList');

            // PUT THIS HERE: Show list skeletons
            list.innerHTML = Array(4).fill(0).map(() => `
        <div class="vault-card flex items-center justify-between p-4 rounded-3xl opacity-50">
            <div class="flex-1 space-y-2">
                <div class="h-3 w-40 skeleton rounded-full"></div>
                <div class="h-2 w-20 skeleton rounded-full"></div>
            </div>
        </div>
    `).join('');
            try {
                const response = await fetch('jitendraunatti.php?action=all_portals', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'x-developed-by': 'JITENDRA_PRO_DEV',
                        'X-POWERED-BY': 'JITENDRA-KUMAR',
                        'X-GITHUB-USERNAME': 'jitendraunatti',
                        'DEV-NAME': 'JITENDRA KUMAR'
                    },
                });
                const data = await response.json();
                savedPortalsData = data.portals || [];

                list.innerHTML = savedPortalsData.map((p, i) => `
                    <div class="vault-card flex items-center justify-between p-4 rounded-3xl group">
                        <div onclick="switchPortal('${p.id}')" class="flex-1 cursor-pointer">
                            <p class="text-xs font-bold text-white group-hover:text-blue-400 transition-colors truncate w-40 md:w-80">${p.URL}</p>
                            <p class="text-[9px] font-mono text-slate-500 uppercase mt-1 tracking-tighter">${p.MAC}</p>
                        </div>
                        <button onclick="inspectPortal(${i})" class="p-3 ml-2 rounded-2xl bg-white/5 hover:bg-blue-600 hover:text-white transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                `).join('');
                lucide.createIcons();
            } catch (e) {
                list.innerHTML = `<p class="text-center text-rose-500 text-[10px] font-black uppercase">Vault Access Denied</p>`;
            }
        }

        function inspectPortal(idx) {
            const p = savedPortalsData[idx];
            document.getElementById('vaultListView').classList.add('hidden');
            document.getElementById('vaultCloseBtn').classList.add('hidden');
            document.getElementById('vaultDetailView').classList.remove('hidden');

            const rows = [{
                    l: 'Portal URL',
                    v: p.URL
                }, {
                    l: 'MAC Address',
                    v: p.MAC
                },
                {
                    l: 'Device SN',
                    v: p.SN || 'N/A'
                }, {
                    l: 'Model',
                    v: p.Model
                },
                {
                    l: 'Device ID 1',
                    v: p.D1 || 'N/A'
                },
                {
                    l: 'Device ID 2',
                    v: p.D2 || 'N/A'
                }, {
                    l: 'Proxy Status',
                    v: p.Proxy || 'AUTO'
                }
            ];
            document.getElementById('portalDetailContent').innerHTML = rows.map(r => `
                <div class="flex flex-col text-left">
                    <span class="text-[8px] font-black text-slate-600 uppercase tracking-widest">${r.l}</span>
                    <span class="text-[11px] font-mono text-slate-300 break-all">${r.v}</span>
                </div>
            `).join('');
            document.getElementById('activatePortalBtn').onclick = () => switchPortal(p.id);
            lucide.createIcons();
        }

        function backToVaultList() {
            document.getElementById('vaultDetailView').classList.add('hidden');
            document.getElementById('vaultListView').classList.remove('hidden');
            document.getElementById('vaultCloseBtn').classList.remove('hidden');
        }

        async function switchPortal(id) {
            const res = await fetch(`jitendraunatti.php?action=switch_portal`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'x-developed-by': 'JITENDRA_PRO_DEV',
                    'X-POWERED-BY': 'JITENDRA-KUMAR',
                    'X-GITHUB-USERNAME': 'jitendraunatti',
                    'DEV-NAME': 'JITENDRA KUMAR'
                },
                body: JSON.stringify({
                    id
                })
            });
            if ((await res.json()).statusCode === 200) window.location.reload();
        }

        // --- CHANNEL RENDERING & ANIMATION ---
        async function fetchChannels() {
            const grid = document.getElementById('channelGrid');

            // PUT THIS HERE: Show 18 skeletons immediately
            grid.innerHTML = Array(18).fill(0).map(() => `
        <div class="channel-card border-none opacity-40">
            <div class="aspect-square skeleton rounded-[1.5rem]"></div>
            <div class="p-3 space-y-2">
                <div class="h-2 w-10 skeleton rounded-full opacity-50"></div>
                <div class="h-3 w-full skeleton rounded-full"></div>
            </div>
        </div>
    `).join('');
            try {
                const response = await fetch('jitendraunatti.php?action=livechannels', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'x-developed-by': 'JITENDRA_PRO_DEV',
                        'X-POWERED-BY': 'JITENDRA-KUMAR',
                        'X-GITHUB-USERNAME': 'jitendraunatti',
                        'DEV-NAME': 'JITENDRA KUMAR'
                    },
                });
                const data = await response.json();
                allChannels = Array.isArray(data) ? data : (data.channels || []);
                renderGenres();
                resetAndLoad();
            } catch (err) {
                grid.innerHTML = `<p class="col-span-full py-10 text-center text-slate-500 uppercase text-xs font-bold">Sync Failed</p>`;
            }
        }

        function renderGenres() {
            const genres = ['all', ...new Set(allChannels.map(c => c.genre).filter(Boolean))];
            const html = genres.map(g => `<div class="genre-item ${g === currentGenre ? 'active' : ''}" onclick="filterByGenre('${g}', this)">${g === 'all' ? 'Discovery' : g}</div>`).join('');
            document.getElementById('genreContainerDesktop').innerHTML = html;
            document.getElementById('genreContainerMobile').innerHTML = html;
        }

        function filterByGenre(g, el) {
            currentGenre = g;
            const grid = document.getElementById('channelGrid');
            grid.classList.remove('grid-fade-in');
            void grid.offsetWidth;
            grid.classList.add('grid-fade-in');

            document.querySelectorAll('.genre-item').forEach(i => i.classList.remove('active'));
            document.getElementById('currentCategoryTitle').innerText = g === 'all' ? 'Discovery' : g;
            resetAndLoad();
        }

        function resetAndLoad() {
            offset = 0;
            document.getElementById('channelGrid').innerHTML = "";
            loadMore();
        }

        function loadMore() {
            const search = (document.getElementById('searchInput').value || document.getElementById('mobileSearch').value).toLowerCase();
            const grid = document.getElementById('channelGrid');
            const filtered = allChannels.filter(c => (currentGenre === 'all' || c.genre === currentGenre) && c.Name.toLowerCase().includes(search));

            document.getElementById('channelCount').innerText = filtered.length;
            const next = filtered.slice(offset, offset + limit);

            if (next.length > 0) {
                next.forEach((c, index) => {
                    const delay = index * 40;
                    // Replace the image part of your card template with this:
                    const html = `
                <a href="play.php?id=${c.playback_url}&name=${c.Name}" class="channel-card group channel-entrance" style="animation-delay: ${delay}ms">
                    <div class="relative aspect-square flex items-center justify-center bg-[#020617] overflow-hidden">
                        
                        <div class="absolute inset-0 opacity-20 group-hover:opacity-40 transition-opacity duration-700 bg-gradient-to-br from-blue-600/20 via-transparent to-purple-600/20"></div>

                        <div class="relative z-10 w-[75%] h-[75%] rounded-full bg-white/5 border border-white/10 backdrop-blur-md flex items-center justify-center p-5 shadow-2xl group-hover:scale-110 group-hover:border-blue-500/50 transition-all duration-500">
                            
                            <img src="${c.logo || getFallback(c.Name)}" 
                                alt="${c.Name}"
                                class="w-full h-full object-contain filter brightness-110"
                                onerror="this.src='${getFallback(c.Name)}'">
                            
                            <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-white/10 to-transparent pointer-events-none"></div>
                        </div>

                        <div class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white scale-0 group-hover:scale-100 transition-transform duration-300 shadow-lg shadow-blue-600/40">
                            <i data-lucide="play" class="w-3.5 h-3.5 fill-current"></i>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-slate-950 border-t border-white/5">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[7px] font-black text-slate-600 uppercase">#${String(c.number).padStart(3, '0')}</span>
                            ${c.Name.toUpperCase().includes('4K') ? '<span class="text-[6px] font-bold text-blue-400 bg-blue-400/10 px-1 rounded-sm">4K</span>' : ''}
                        </div>
                        <h3 class="font-bold text-[10px] text-slate-200 truncate uppercase tracking-tight group-hover:text-blue-500 transition-colors">${c.Name}</h3>
                    </div>
                </a>`;
                    grid.insertAdjacentHTML('beforeend', html);
                });
                offset += limit;
                lucide.createIcons();
            }
        }

        document.getElementById('searchInput').addEventListener('input', resetAndLoad);
        document.getElementById('mobileSearch').addEventListener('input', resetAndLoad);
        const observer = new IntersectionObserver((e) => {
            if (e[0].isIntersecting) loadMore();
        }, {
            threshold: 0.1
        });
        observer.observe(document.getElementById('loadMoreTrigger'));
        window.addEventListener('DOMContentLoaded', fetchChannels);
    </script>
</body>

</html>