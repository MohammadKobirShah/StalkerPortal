<?php
require_once 'jitendraunatti.php';
global $SCARLET_WITCH;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | <?php echo htmlspecialchars($SCARLET_WITCH['JITENDRA_UNIVERSE']['DEV_NAME']); ?></title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/GQCh1t2b/Screenshot-2026-04-13-at-3-50-15-PM.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            min-height: 100vh;
            color: #f1f5f9;
            overflow-x: hidden;
        }

        /* Premium Glass Effects */
        .glass-panel {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-premium {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid #334155;
            transition: all 0.3s ease;
        }

        .input-premium:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
        }

        /* Typography */
        .data-label {
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #64748b;
        }

        .status-badge {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        /* Custom UI Components */
        .portal-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .portal-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .portal-scroll::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }

        .animate-flicker {
            animation: flicker 2s linear infinite;
        }

        @keyframes flicker {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center p-4 md:p-10">

    <div id="toast-container" class="fixed top-6 right-6 z-[100] space-y-3"></div>

    <div id="portalModal" class="hidden fixed inset-0 z-[80] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-in fade-in duration-300">
        <div class="glass-panel w-full max-w-2xl rounded-[2.5rem] overflow-hidden shadow-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-white flex items-center gap-3">
                    <i data-lucide="layers" class="text-blue-500"></i> Portal Vault
                </h2>
                <button onclick="togglePortalModal(false)" class="text-slate-500 hover:text-white transition-colors">
                    <i data-lucide="x-circle"></i>
                </button>
            </div>
            <div id="portalList" class="portal-scroll space-y-3 max-h-[400px] overflow-y-auto pr-2">
            </div>
            <button onclick="togglePortalModal(false)" class="w-full mt-6 py-4 rounded-2xl border border-white/10 text-slate-400 font-bold hover:bg-white/5 transition-all">
                Close Vault
            </button>
        </div>
    </div>

    <div id="login-container" class="hidden glass-panel w-full max-w-3xl rounded-[2.5rem] overflow-hidden shadow-2xl">
        <div class="p-8 pb-4 text-center">
            <div class="inline-flex p-3 rounded-2xl bg-blue-500/10 text-blue-400 mb-4">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-white">Handshake Engine</h1>
            <p class="text-slate-400 text-sm mt-2 font-medium uppercase tracking-[0.2em]">Authorized Access Portal</p>
        </div>

        <form id="handshakeForm" class="p-8 pt-4 space-y-6" autocomplete="off">
            <div class="space-y-4 text-left">
                <div class="relative">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Portal URL <span class="text-blue-500">*</span></label>
                    <input type="url" name="URL" required placeholder="https://github.com/Jitendraunatti/Stalker-Portal" class="input-premium w-full p-4 rounded-2xl mt-1 text-sm pl-11">
                    <i data-lucide="globe" class="w-4 h-4 absolute left-4 top-[43px] text-slate-500"></i>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">MAC Address <span class="text-blue-500">*</span></label>
                        <input type="text" name="MAC" required placeholder="00:1A:79:XX:XX:XX" class="input-premium w-full p-4 rounded-2xl mt-1 text-sm pl-11">
                        <i data-lucide="monitor" class="w-4 h-4 absolute left-4 top-[43px] text-slate-500"></i>
                    </div>
                    <div class="relative">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Serial Number (Optional)</label>
                        <input type="text" name="SN" placeholder="Enter Device SN" class="input-premium w-full p-4 rounded-2xl mt-1 text-sm pl-11">
                        <i data-lucide="fingerprint" class="w-4 h-4 absolute left-4 top-[43px] text-slate-500"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-slate-900/30 rounded-3xl border border-white/5 text-left">
                <div>
                    <label class="text-[10px] font-bold text-slate-600 uppercase">Device ID 1</label>
                    <input type="text" name="D1" placeholder="Optional" class="bg-transparent border-b border-slate-700 w-full p-2 text-sm focus:border-blue-500 outline-none transition-colors">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-600 uppercase">Device ID 2</label>
                    <input type="text" name="D2" placeholder="Optional" class="bg-transparent border-b border-slate-700 w-full p-2 text-sm focus:border-blue-500 outline-none transition-colors">
                </div>
                <div>
                    <label class="text-[10px] font-bold text-slate-600 uppercase">Signature (SG)</label>
                    <input type="text" name="SG" placeholder="Optional" class="bg-transparent border-b border-slate-700 w-full p-2 text-sm focus:border-blue-500 outline-none transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <select name="Model" class="input-premium p-3 rounded-xl text-xs font-bold text-slate-300">
                    <option value="MAG250">MAG250</option>
                    <option value="MAG254">MAG254</option>
                    <option value="MAG270">MAG270</option>
                </select>
                <select name="Proxy" class="input-premium p-3 rounded-xl text-xs font-bold text-slate-300">
                    <option value="DIRECT">PROXY: DIRECT</option>
                    <option value="DIRECT">DIRECT</option>
                    <option value="PROXY">PROXY</option>
                </select>
                <select name="API" class="input-premium p-3 rounded-xl text-xs font-bold text-slate-300">
                    <option value="263">API: 263</option>
                    <option value="262">262</option>
                </select>
                <select name="Share" class="input-premium p-3 rounded-xl text-xs font-bold text-slate-300">
                    <option value="OFF">SHARING: OFF</option>
                    <option value="ON">ON</option>
                </select>
            </div>

            <button type="submit" id="submitBtn" class="btn-gradient w-full py-5 rounded-[1.5rem] font-bold text-white text-lg flex items-center justify-center gap-3 transition-all">
                <i data-lucide="zap" class="w-6 h-6"></i>
                <span>Initialize Handshake</span>
            </button>
        </form>

        <div class="pb-8 text-center border-t border-white/5 pt-6">
            <button onclick="fetchSavedPortals()" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-white transition-all">
                <i data-lucide="archive" class="inline w-3 h-3 mr-1 mb-1"></i> Browse Saved Vault
            </button>
        </div>
    </div>

    <div id="successDisplay" class="hidden w-full max-w-6xl space-y-6 animate-in fade-in slide-in-from-bottom-5">
        <div class="glass-panel rounded-[2.5rem] p-8">
            <div class="flex flex-col md:flex-row items-start justify-between gap-6 mb-10 pb-6 border-b border-white/5 text-left">
                <div class="flex items-center gap-5">
                    <div class="relative">
                        <div class="p-4 bg-emerald-500/20 rounded-3xl border border-emerald-500/30">
                            <i data-lucide="verified" class="w-8 h-8 text-emerald-400"></i>
                        </div>
                        <span class="absolute -top-1 -right-1 flex h-4 w-4">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-4 border-slate-900"></span>
                        </span>
                    </div>
                    <div>
                        <h2 class="text-white text-2xl font-black uppercase tracking-tight">Handshake Success</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="status-badge px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-tighter">Verified Link</span>
                            <p id="systemIp" class="text-slate-500 text-[10px] font-mono"></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <button onclick="fetchSavedPortals()" class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-6 py-4 rounded-2xl text-xs font-bold transition-all border border-white/5">
                        <i data-lucide="layers" class="w-4 h-4"></i><span>Switch Vault</span>
                    </button>
                    <a href="index.php" class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-4 rounded-2xl text-xs font-bold transition-all shadow-lg">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i><span>Open Grid</span>
                    </a>
                </div>
            </div>

            <div id="resultsContent" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-left"></div>

            <div class="mt-8 p-5 bg-black/30 rounded-3xl border border-white/5 flex flex-wrap gap-8 items-center justify-center">
                <div class="flex items-center gap-3 text-left">
                    <i data-lucide="server" class="w-4 h-4 text-slate-500"></i>
                    <div class="leading-none">
                        <p class="data-label mb-1">Portal URL</p>
                        <p id="portalUrl" class="text-[10px] font-bold text-slate-300"></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-left">
                    <i data-lucide="hard-drive" class="w-4 h-4 text-slate-500"></i>
                    <div class="leading-none">
                        <p class="data-label mb-1">STB Version</p>
                        <p id="stbVersion" class="text-[10px] font-bold text-slate-300"></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-left">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-500"></i>
                    <div class="leading-none">
                        <p class="data-label mb-1">Handshake Date</p>
                        <p id="lastActive" class="text-[10px] font-bold text-slate-300"></p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-white/5 text-left">
                <h3 class="data-label text-blue-400 mb-6 flex items-center gap-2"><i data-lucide="cpu" class="w-4 h-4"></i> Hardware Fingerprint</h3>
                <div id="metaGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-6 gap-x-8"></div>
            </div>
        </div>

        <button onclick="showLoginForm()" class="mt-10 text-[10px] font-black text-slate-500 uppercase hover:text-rose-400 transition-colors flex items-center gap-2 mx-auto tracking-widest">
            <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Clear & New Login
        </button>
    </div>

    <script>
        lucide.createIcons();

        // 1. TOAST SYSTEM
        const pushToast = (message, type = 'success') => {
            const container = document.getElementById('toast-container');
            const el = document.createElement('div');
            const styles = type === 'success' ? 'border-emerald-500/50 text-emerald-400 bg-emerald-500/10' : 'border-rose-500/50 text-rose-400 bg-rose-500/10';
            el.className = `p-4 px-6 rounded-2xl backdrop-blur-xl border ${styles} shadow-2xl flex items-center gap-3 animate-in slide-in-from-right-full duration-300`;
            el.innerHTML = `<i data-lucide="${type === 'success' ? 'check-circle' : 'alert-circle'}" class="w-5 h-5"></i><span class="text-sm font-semibold">${message}</span>`;
            container.appendChild(el);
            lucide.createIcons();
            setTimeout(() => {
                el.classList.add('animate-out', 'fade-out', 'slide-out-to-right-full');
                setTimeout(() => el.remove(), 500);
            }, 4000);
        };

        // 2. VAULT / MODAL LOGIC
        function togglePortalModal(show) {
            document.getElementById('portalModal').classList.toggle('hidden', !show);
        }

        async function fetchSavedPortals() {
            togglePortalModal(true);
            const list = document.getElementById('portalList');
            list.innerHTML = '<div class="text-center py-20 animate-pulse text-slate-500 uppercase text-[10px] font-black tracking-widest">Scanning Secure Vault...</div>';

            try {
                // Fetching the list of all portals
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

                if (!data.portals || data.portals.length === 0) {
                    list.innerHTML = '<div class="text-center py-20 text-slate-600 uppercase text-[10px] font-black tracking-widest">Vault is Empty</div>';
                    return;
                }

                // IMPORTANT: We use p.id here because PHP action "all_portals" sends "id" (filename without .json)
                list.innerHTML = data.portals.map(p => `
                    <div onclick="selectSavedPortal('${p.id}')" class="group flex items-center justify-between p-5 rounded-3xl bg-slate-900/50 border border-white/5 hover:border-blue-500/40 hover:bg-blue-600/5 transition-all cursor-pointer">
                        <div class="flex items-center gap-4 text-left">
                            <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-600 group-hover:text-blue-400 transition-colors"><i data-lucide="server"></i></div>
                            <div>
                                <p class="text-[12px] font-bold text-white group-hover:text-blue-400">${p.URL.replace('http://', '').split('/')[0]}</p>
                                <p class="text-[9px] font-mono text-slate-500 uppercase tracking-tighter">${p.MAC}</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-800 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"></i>
                    </div>
                `).join('');
                lucide.createIcons();
            } catch (e) {
                pushToast("Vault connection failed", "error");
            }
        }

        async function selectSavedPortal(portalId) {
            try {
                const response = await fetch('jitendraunatti.php?action=switch_portal', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'x-developed-by': 'JITENDRA_PRO_DEV',
                        'X-POWERED-BY': 'JITENDRA-KUMAR',
                        'X-GITHUB-USERNAME': 'jitendraunatti',
                        'DEV-NAME': 'JITENDRA KUMAR'
                    },
                    body: JSON.stringify({
                        id: portalId
                    })
                });

                const res = await response.json();

                if (res.statusCode === 200) {
                    pushToast("Portal Successfully Switched", "success");
                    togglePortalModal(false);
                    // Reload to trigger the DOMContentLoaded session check with new portal
                    setTimeout(() => window.location.reload(), 800);
                } else {
                    pushToast(res.message || "Switch failed", "error");
                }
            } catch (e) {
                pushToast("Portal switch failed", "error");
            }
        }

        // 3. RENDER RESULTS ENGINE
        function showResults(data) {
            document.getElementById('login-container').classList.add('hidden');
            document.getElementById('successDisplay').classList.remove('hidden');
            const js = data.data?.js || {};

            document.getElementById('systemIp').innerText = "Virtual IP: " + (js.ip || "Protected");
            document.getElementById('portalUrl').innerText = data.URL ? data.URL : "N/A";
            document.getElementById('stbVersion').innerText = (js.stb_type || "MAG") + " | Ver: " + (js.image_version || "N/A");
            document.getElementById('lastActive').innerText = data.Date || "N/A";

            const items = [{
                    label: 'Subscriber',
                    val: data.Name,
                    icon: 'user',
                    color: 'text-blue-400'
                },
                {
                    label: 'MAC Address',
                    val: data.mac,
                    icon: 'monitor',
                    color: 'text-slate-300'
                },
                {
                    label: 'Password',
                    val: data.Password,
                    icon: 'lock',
                    color: 'text-rose-400'
                },
                {
                    label: 'Parent PIN',
                    val: data.parent_password || js.parent_password || '0000',
                    icon: 'shield-alert',
                    color: 'text-amber-400'
                },
                {
                    label: 'Country',
                    val: js.country || 'Global',
                    icon: 'map-pin',
                    color: 'text-cyan-400'
                },
                {
                    label: 'Expiry Date',
                    val: data.expirydate === "0000-00-00 00:00:00" ? "Unlimited" : data.expirydate,
                    icon: 'zap',
                    color: 'text-emerald-400'
                },
                {
                    label: 'Username',
                    val: data.login,
                    icon: 'at-sign',
                    color: 'text-indigo-400'
                },
                {
                    label: 'Hardware ID',
                    val: js.hw_version || 'N/A',
                    icon: 'cpu',
                    color: 'text-slate-400'
                }
            ];
            console.log(items);
            document.getElementById('resultsContent').innerHTML = items.map(item => `
                <div class="p-6 rounded-[2rem] border border-white/5 bg-slate-900/40 relative overflow-hidden text-left">
                    <div class="flex flex-col gap-4">
                        <div class="p-3 w-fit rounded-2xl bg-white/5 ${item.color}"><i data-lucide="${item.icon}" class="w-5 h-5"></i></div>
                        <div><p class="data-label mb-1">${item.label}</p><h3 class="text-sm font-bold truncate ${item.color}">${item.val}</h3></div>
                    </div>
                </div>
            `).join('');

            const metaItems = [{
                    label: 'Device ID 1',
                    val: data.device_id || 'N/A'
                },
                {
                    label: 'Device ID 2',
                    val: data.device_id2 || 'N/A'
                },
                {
                    label: 'Signature',
                    val: data.sig || 'N/A'
                },
                {
                    label: 'Settings Pass',
                    val: data.settings_password || '0000'
                }
            ];

            document.getElementById('metaGrid').innerHTML = metaItems.map(i => `
            <div class="flex flex-col border-l-2 border-white/10 pl-4 text-left">
                <span class="data-label mb-1">${i.label}</span>
                <span class="text-xs font-mono text-slate-400 break-all">${i.val}</span>
            </div>
            `).join('');
            lucide.createIcons();
        }

        // 4. SESSION & FORM HANDLERS
        window.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch('jitendraunatti.php?action=login_details', {
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
                if (data.JITENDRAUNATTI && data.JITENDRAUNATTI.statusCode === 200) {
                    showResults(data.JITENDRAUNATTI);
                    pushToast("Session Identity Restored");
                } else {
                    showLoginForm();
                }
            } catch (e) {
                showLoginForm();
            }
        });

        document.getElementById('handshakeForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.querySelector('span').innerText = "Authenticating...";
            try {
                const response = await fetch('jitendraunatti.php?action=login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'x-developed-by': 'JITENDRA_PRO_DEV',
                        'X-POWERED-BY': 'JITENDRA-KUMAR',
                        'X-GITHUB-USERNAME': 'jitendraunatti',
                        'DEV-NAME': 'JITENDRA KUMAR'
                    },
                    body: JSON.stringify(Object.fromEntries(new FormData(this)))
                });
                const result = await response.json();
                if (result.JITENDRAUNATTI?.statusCode === 200) {
                    showResults(result.JITENDRAUNATTI);
                    pushToast("Portal Access Granted", "success");
                } else {
                    pushToast(result.JITENDRAUNATTI?.message || "Handshake Failed", "error");
                }
            } catch (err) {
                pushToast("Server Communication Error", "error");
            } finally {
                btn.disabled = false;
                btn.querySelector('span').innerText = "Initialize Handshake";
            }
        });

        function showLoginForm() {
            document.getElementById('successDisplay').classList.add('hidden');
            document.getElementById('login-container').classList.remove('hidden');
        }
    </script>
</body>

</html>