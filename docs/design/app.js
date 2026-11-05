(function(){
  var CARD = 'bg-card rounded-[20px] p-4 sm:p-5 flex items-center justify-between border border-line/60 shadow-soft';
  var I = {
    grid: '<rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/>',
    wallet: '<rect x="3" y="4" width="18" height="16" rx="3"/><circle cx="9" cy="10" r="2"/><path d="M15 8h2M15 12h2M7 16h10"/>',
    chart: '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
    building: '<path d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M9 9h1M9 13h1M9 17h1M14 9h1M14 13h1M14 17h1"/>',
    users: '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
    cal: '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M9 16l2 2 4-4"/>',
    set: '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/>',
    out: '<path d="M9 4H5a1 1 0 00-1 1v14a1 1 0 001 1h4M16 8l4 4-4 4M20 12H9"/>',
    search: '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
    msg: '<path d="M4 5h16v11H9l-5 4z"/>',
    user: '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    money: '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M15 9.5a2.5 2.5 0 0 0-5 0c0 3 5 2 5 5a2.5 2.5 0 0 1-5 0"/>'
  };

  function ic(n) {
    return '<svg class="ic" viewBox="0 0 24 24" aria-hidden="true">' + (I[n] || '') + '</svg>';
  }

  var B = 'w-10 h-10 sm:w-11 sm:h-11 rounded-full grid place-items-center transition-all ';
  var navItems = [
    { id: 'grid', label: 'Dashboard', active: true },
    { id: 'wallet', label: 'Nodes / Wallet' },
    { id: 'chart', label: 'Tren' },
    { id: 'building', label: 'Stasiun Pesisir' },
    { id: 'users', label: 'Pengelola' },
    { id: 'cal', label: 'Log Riwayat' }
  ];

  var sideEl = document.getElementById('side');
  if (sideEl) {
    sideEl.innerHTML = navItems.map(function(item) {
      return '<button aria-label="' + item.label + '" title="' + item.label + '" class="' + B + (item.active ? 'bg-dark text-white shadow-md' : 'text-mute hover:bg-tint hover:text-sea') + '">' + ic(item.id) + '</button>';
    }).join('') +
    '<div class="hidden lg:block flex-1 min-h-[30px]"></div>' +
    '<button aria-label="Pengaturan" class="' + B + 'text-mute hover:bg-tint hover:text-sea">' + ic('set') + '</button>' +
    '<button aria-label="Keluar" class="' + B + 'text-mute hover:bg-tint hover:text-bad">' + ic('out') + '</button>' +
    '<div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-gradient-to-br from-sea to-deep border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs"><img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Avatar" class="w-full h-full object-cover"></div>';
  }

  // State mode (image demo vs sawarna cuaca)
  var mode = 'image';
  var P = [
    { n: 'Kecepatan Angin', u: 'km/jam', b: 20, a: 10, now: 34, d: 0, w: 1 },
    { n: 'Suhu Udara', u: '°C', b: 28, a: 3, now: 29.4, d: 1 },
    { n: 'Kelembapan', u: '%', b: 80, a: 8, now: 84, d: 0 },
    { n: 'Tekanan Udara', u: 'hPa', b: 1009, a: 2, now: 1008.6, d: 1 }
  ];

  var N = 168, s = 7;
  function rnd() { s = (s * 9301 + 49297) % 233280; return s / 233280; }
  P.forEach(function(p, j) {
    p.v = [];
    for (var i = 0; i < N; i++) {
      var x = p.b + p.a * Math.sin(i / 24 * 6.283 - (j ? 0 : 2)) + (rnd() - 0.5) * p.a * 0.6;
      p.v.push(x);
    }
    p.v[N - 1] = p.now;
  });

  function renderStats() {
    var statsEl = document.getElementById('stats');
    if (!statsEl) return;

    var bars = [40, 70, 55, 90, 60].map(function(h) {
      return '<i class="w-1.5 sm:w-2 rounded-full bg-sea" style="height:' + h + '%"></i>';
    }).join('');

    if (mode === 'image') {
      statsEl.innerHTML =
        '<div class="' + CARD + '"><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">Spent this month</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">$682.5</div></div><div class="flex gap-1.5 items-end h-10 sm:h-11 px-1">' + bars + '</div></div>' +
        '<div class="' + CARD + '"><div class="flex items-center gap-3"><div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0">' + ic('user') + '</div><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">New clients</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">321</div></div></div><svg width="70" height="30" viewBox="0 0 70 30" class="shrink-0"><path d="M 0 20 Q 15 5, 30 18 T 60 10 T 70 12" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"/></svg></div>' +
        '<div class="' + CARD + '"><div class="flex items-center gap-3"><div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0">' + ic('money') + '</div><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">Earnings</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">$350.40</div></div></div><span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-tint text-sea border border-line/60">+12%</span></div>' +
        '<div class="' + CARD.replace('bg-card', 'bg-gradient-to-br from-sea to-deep text-white border-0 shadow-card') + '"><div><span class="text-white/80 text-xs sm:text-[13.5px] font-medium block">Activity</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-white mt-0.5">$540.50</div></div><svg width="85" height="32" viewBox="0 0 85 32" class="shrink-0"><path d="M 0 22 Q 22 4, 45 18 T 85 10" fill="none" stroke="#ffffff" stroke-width="2.8" stroke-linecap="round"/></svg></div>';
    } else {
      statsEl.innerHTML =
        '<div class="' + CARD + '"><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">Suhu Udara</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">29,4 <small class="text-xs text-mute font-medium">°C</small></div><span class="text-[11px] text-ok font-semibold inline-flex items-center gap-1 mt-0.5">+0.8°C stabil</span></div><div class="flex gap-1.5 items-end h-10 sm:h-11 px-1">' + bars + '</div></div>' +
        '<div class="' + CARD + '"><div class="flex items-center gap-3"><div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0"><i class="fa-solid fa-droplet text-base"></i></div><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">Kelembapan</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">84 <small class="text-xs text-mute font-medium">%</small></div></div></div><svg width="70" height="30" viewBox="0 0 70 30" class="shrink-0"><path d="M 0 20 Q 15 5, 30 18 T 60 10 T 70 12" fill="none" stroke="var(--sea)" stroke-width="2.5" stroke-linecap="round"/></svg></div>' +
        '<div class="' + CARD + '"><div class="flex items-center gap-3"><div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-tint text-sea grid place-items-center shrink-0"><i class="fa-solid fa-gauge-high text-base"></i></div><div><span class="text-mute text-xs sm:text-[13.5px] font-medium block">Tekanan Udara</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-ink mt-0.5">1008,6 <small class="text-xs text-mute font-medium">hPa</small></div></div></div><span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-tint text-sea border border-line/60">Stabil</span></div>' +
        '<div class="' + CARD.replace('bg-card', 'bg-gradient-to-br from-sea to-deep text-white border-0 shadow-card') + '"><div><span class="text-white/80 text-xs sm:text-[13.5px] font-medium block">Kecepatan Angin</span><div class="text-2xl sm:text-[28px] font-bold tracking-tight text-white mt-0.5">34 <small class="text-xs text-white/80 font-medium">km/j</small></div></div><svg width="85" height="32" viewBox="0 0 85 32" class="shrink-0"><path d="M 0 22 Q 22 4, 45 18 T 85 10" fill="none" stroke="#ffffff" stroke-width="2.8" stroke-linecap="round"/></svg></div>';
    }
  }

  // Populate Select Parameters
  var ps = document.getElementById('ps'), rs = document.getElementById('rs'), cur = 0;
  if (ps) {
    P.forEach(function(p, i) {
      ps.insertAdjacentHTML('beforeend', '<option value="' + i + '">' + p.n + '</option>');
    });
    ps.onchange = function() { cur = +ps.value; draw(); };
  }
  if (rs) {
    rs.onchange = draw;
  }

  function draw() {
    var box = document.getElementById('cw');
    if (!box) return;
    var W = box.clientWidth || 550, H = box.clientHeight || 180, rng = +(rs ? rs.value : 24), p = P[cur], v = p.v.slice(-rng), L = 35, B = 20, T = 10, R = 15;
    var mn = Math.min.apply(0, v), mx = Math.max.apply(0, v), pad = (mx - mn) * 0.1 || 1, lo = mn - pad, hi = mx + pad;
    var x = function(i) { return L + i / (v.length - 1) * (W - L - R); };
    var y = function(a) { return T + (1 - (a - lo) / (hi - lo)) * (H - T - B); };

    var o = '<defs><linearGradient id="chartGr" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="var(--sea)" stop-opacity=".3"/><stop offset="1" stop-color="var(--sea)" stop-opacity="0"/></linearGradient></defs>';
    for (var g = 0; g <= 3; g++) {
      var val = lo + (hi - lo) * g / 3, yy = y(val);
      o += '<line x1="' + L + '" x2="' + (W - R) + '" y1="' + yy + '" y2="' + yy + '" stroke="var(--line)" stroke-dasharray="3 3"/>';
    }

    var q = v.map(function(a, k) { return [x(k), y(a)]; });
    var d = 'M ' + q[0][0].toFixed(1) + ' ' + q[0][1].toFixed(1);
    for (var i = 1; i < q.length - 1; i++) {
      var xc = (q[i][0] + q[i + 1][0]) / 2;
      var yc = (q[i][1] + q[i + 1][1]) / 2;
      d += ' Q ' + q[i][0].toFixed(1) + ' ' + q[i][1].toFixed(1) + ', ' + xc.toFixed(1) + ' ' + yc.toFixed(1);
    }
    d += ' L ' + q[q.length - 1][0].toFixed(1) + ' ' + q[q.length - 1][1].toFixed(1);

    o += '<path d="' + d + ' L ' + (W - R) + ' ' + (H - B) + ' L ' + L + ' ' + (H - B) + ' Z" fill="url(#chartGr)"/>';
    if (p.w) {
      var ty = y(30);
      o += '<line x1="' + L + '" x2="' + (W - R) + '" y1="' + ty + '" y2="' + ty + '" stroke="var(--warn)" stroke-dasharray="5 4" stroke-width="1.5"/><text x="' + (W - R) + '" y="' + (ty - 4) + '" text-anchor="end" style="fill:var(--warn);font-weight:600">batas waspada 30</text>';
    }
    o += '<path d="' + d + '" fill="none" stroke="var(--sea)" stroke-width="3" stroke-linecap="round"/>';

    var c = document.getElementById('chart');
    if (c) {
      c.setAttribute('viewBox', '0 0 ' + W + ' ' + H);
      c.innerHTML = o;
    }
  }

  // Toggle Mode Button
  var modeBtn = document.getElementById('mode-btn');
  if (modeBtn) {
    modeBtn.onclick = function() {
      mode = (mode === 'image') ? 'sawarna' : 'image';
      var isSawarna = mode === 'sawarna';
      document.getElementById('head-title').textContent = isSawarna ? 'Halo, Pengelola Sawarna!' : 'Hello, Carlic!';
      document.getElementById('head-subtitle').textContent = isSawarna ? 'Pantau telemetri cuaca mikro dan peringatan dini kawasan Pantai Sawarna' : 'Explore information and activity about your property';
      document.getElementById('mode-btn-text').textContent = isSawarna ? 'Ganti Mode: Referensi Gambar' : 'Ganti Mode: Sawarna IoT';
      document.getElementById('tren-title').textContent = isSawarna ? 'Tren Parameter Cuaca' : 'Balance';
      document.getElementById('tren-badge').textContent = isSawarna ? 'Waspada' : 'On track';
      document.getElementById('saves-val').textContent = isSawarna ? '34,0 km/j' : '43.50%';
      document.getElementById('balance-val').textContent = isSawarna ? '24,2 km/j' : '$52,422';
      document.getElementById('gauge-title').textContent = isSawarna ? 'Curah Hujan' : 'Earnings';
      document.getElementById('gauge-val').textContent = isSawarna ? '18,4 mm' : '$6078.76';
      document.getElementById('gauge-sub').textContent = isSawarna ? 'Batas waspada 10 mm/jam · Intensitas terkontrol' : 'Profit is 34% More than last Month';
      document.getElementById('gauge-center').textContent = isSawarna ? '3,2' : '80%';
      document.getElementById('gauge-footer').innerHTML = isSawarna ? 'mm/jam · <b class="text-ok">Aman Terkendali</b>' : 'mm/jam · <b class="text-ok">Status Normal</b>';
      document.getElementById('col1-t').textContent = isSawarna ? 'Arah' : 'Projects';
      document.getElementById('col1-v').textContent = isSawarna ? '225°' : '26';
      document.getElementById('col2-t').textContent = isSawarna ? 'Hembusan' : 'Followers';
      document.getElementById('col2-v').textContent = isSawarna ? '41' : '356';
      document.getElementById('col3-t').textContent = isSawarna ? 'Rata-rata' : 'Following';
      document.getElementById('col3-v').textContent = isSawarna ? '28' : '68';

      document.getElementById('w-title').innerHTML = isSawarna ? 'Perangkat Terpasang<br>(Hardware Health)' : 'Available Credit<br>Card in Wallet';
      document.getElementById('w-desc').textContent = isSawarna ? '3 Node Sensor terhubung via LoRaWAN & Gateway 4G. Panel surya dan baterai pengisi daya aktif.' : 'Lorem ipsum dolor sit amet consectetur. Facilisis tincidunt purus id hendrerit cras massa sollicitudin adipiscing.';
      document.getElementById('w-btn').innerHTML = isSawarna ? '<i class="fa-solid fa-plus text-[10px]"></i> Konfigurasi Node +' : '<i class="fa-solid fa-plus text-[10px]"></i> Add New Card +';

      document.getElementById('tx-title').textContent = isSawarna ? 'Log Peringatan Dini' : 'Your Transfers';
      document.getElementById('tx1-t').textContent = isSawarna ? 'Angin kencang 34 km/jam' : 'From Anna Jones';
      document.getElementById('tx1-s').textContent = isSawarna ? 'Hari ini, 09.40' : 'Today, 14:34';
      document.getElementById('tx1-b').textContent = isSawarna ? 'Aktif' : '+2.45%';
      document.getElementById('tx2-t').textContent = isSawarna ? 'Hujan lebat 18 mm/jam' : 'To Carlos Brown III';
      document.getElementById('tx2-s').textContent = isSawarna ? '3 Nov, 16.10' : 'Today, 15:23';
      document.getElementById('tx2-b').textContent = isSawarna ? 'Selesai' : '-4.75%';

      document.getElementById('sec-t').textContent = isSawarna ? 'Data Cloud & Integritas' : 'Keep you safe!';
      document.getElementById('sec-s').textContent = isSawarna ? '38 data menunggu sinkron · Enkripsi telemetri aktif' : 'Update your security password';
      document.getElementById('sec-b').textContent = isSawarna ? 'Sinkronkan Sekarang' : 'Update Your Security';

      renderStats();
      draw();
    };
  }

  renderStats();
  draw();
  window.addEventListener('resize', draw);
})();
