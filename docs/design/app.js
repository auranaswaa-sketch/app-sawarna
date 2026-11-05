(function(){
  var I = {
    grid: '<rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/>',
    cpu: '<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>',
    chart: '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
    tower: '<path d="M12 2v20M4.93 4.93a10 10 0 0 1 14.14 0M7.76 7.76a6 6 0 0 1 8.48 0M2 18l10-6 10 6"/>',
    shield: '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    cal: '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M9 16l2 2 4-4"/>',
    set: '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/>',
    out: '<path d="M9 4H5a1 1 0 00-1 1v14a1 1 0 001 1h4M16 8l4 4-4 4M20 12H9"/>'
  };

  function ic(n) {
    return '<svg class="ic" viewBox="0 0 24 24" aria-hidden="true">' + (I[n] || '') + '</svg>';
  }

  var B = 'w-10 h-10 sm:w-11 sm:h-11 rounded-full grid place-items-center transition-all ';
  var isPerangkat = window.location.pathname.indexOf('perangkat') !== -1;
  var isGrafik = window.location.pathname.indexOf('grafik') !== -1;
  var isSettings = window.location.pathname.indexOf('settings') !== -1;
  var isProfile = window.location.pathname.indexOf('profile') !== -1;
  var isIndex = !isPerangkat && !isGrafik && !isSettings && !isProfile;

  var navItems = [
    { id: 'grid', label: 'Dashboard', url: 'index.html', active: isIndex },
    { id: 'cpu', label: 'Perangkat Sensor', url: 'perangkat.html', active: isPerangkat },
    { id: 'chart', label: 'Grafik Tren', url: 'grafik.html', active: isGrafik },
    { id: 'tower', label: 'Stasiun Pesisir', url: 'perangkat.html', active: false },
    { id: 'shield', label: 'Profil Petugas', url: 'profile.html', active: isProfile },
    { id: 'cal', label: 'Log Riwayat', url: 'grafik.html', active: false }
  ];

  var sideEl = document.getElementById('side');
  if (sideEl) {
    sideEl.innerHTML = navItems.map(function(item) {
      return '<a href="' + item.url + '" aria-label="' + item.label + '" title="' + item.label + '" class="' + B + (item.active ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea') + '">' + ic(item.id) + '</a>';
    }).join('') +
    '<div class="hidden lg:block flex-1 min-h-[30px]"></div>' +
    '<a href="settings.html" aria-label="Pengaturan" title="Pengaturan Ambang Batas Sensor" class="' + B + (isSettings ? 'bg-dark text-white shadow-md hover:scale-105 active:scale-95' : 'text-mute hover:bg-tint hover:text-sea') + '">' + ic('set') + '</a>' +
    '<a href="index.html" aria-label="Keluar" title="Keluar Sesi" class="' + B + 'text-mute hover:bg-tint hover:text-bad">' + ic('out') + '</a>' +
    '<a href="profile.html" title="Profil Administrator Sawarna" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden bg-dark border-2 border-white/70 shadow-sm grid place-items-center text-white font-bold text-xs cursor-pointer hover:ring-2 ring-sea transition-all"><span>SW</span></a>';
  }

  var paramData = {
    suhu: {
      max: "30,8 °C", avg: "28,1 °C", min: "23,9 °C",
      d: "M 36 170 L 60 185 L 90 180 L 115 150 L 140 165 L 180 120 L 210 115 L 260 40 L 300 30 L 330 65 L 360 110 L 390 95 L 430 155 L 470 155 L 490 100 L 530 110"
    },
    kelembapan: {
      max: "92 %", avg: "84 %", min: "76 %",
      d: "M 36 60 L 80 50 L 140 80 L 200 110 L 260 140 L 320 90 L 380 70 L 440 60 L 530 80"
    },
    tekanan: {
      max: "1009,4 hPa", avg: "1008,6 hPa", min: "1007,8 hPa",
      d: "M 36 120 L 100 110 L 180 90 L 260 100 L 340 130 L 420 110 L 530 95"
    },
    hujan: {
      max: "18,0 mm/j", avg: "3,2 mm/j", min: "0,0 mm/j",
      d: "M 36 175 L 100 170 L 180 130 L 260 90 L 340 160 L 420 175 L 530 175"
    },
    angin: {
      max: "34,0 km/j", avg: "24,2 km/j", min: "14,0 km/j",
      d: "M 36 140 L 90 120 L 160 150 L 230 110 L 300 60 L 370 70 L 440 90 L 530 50"
    }
  };

  window.setTab = function(param) {
    document.querySelectorAll('.t-btn').forEach(function(btn) {
      btn.className = 't-btn px-3 py-1 rounded-full text-xs font-semibold bg-bg/80 text-mute hover:text-ink border border-line';
    });
    var activeBtn = document.getElementById('tab-' + param);
    if (activeBtn) {
      activeBtn.className = 't-btn px-3 py-1 rounded-full text-xs font-semibold bg-dark text-white shadow-sm';
    }

    var data = paramData[param];
    if (data) {
      document.getElementById('t-max').textContent = data.max;
      document.getElementById('t-avg').textContent = data.avg;
      document.getElementById('t-min').textContent = data.min;

      var line = document.getElementById('chart-line');
      var area = document.getElementById('chart-area');
      if (line && area) {
        line.setAttribute('d', data.d);
        area.setAttribute('d', data.d + ' L 530 180 L 36 180 Z');
      }
    }
  };

  window.setRng = function(rng) {
    var b24 = document.getElementById('r-24');
    var b168 = document.getElementById('r-168');
    if (rng === '24') {
      b24.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold bg-card text-ink shadow-sm';
      b168.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold text-mute hover:text-ink';
    } else {
      b168.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold bg-card text-ink shadow-sm';
      b24.className = 'px-2.5 py-0.5 rounded-full text-xs font-semibold text-mute hover:text-ink';
    }
  };
})();
