// Data di bawah ini DUMMY. Ganti dengan fetch('/api/readings') saat API cloud sudah siap.
(function(){
var CARD='bg-card rounded-[20px] px-[18px] py-4 min-h-0 min-w-0 flex items-center justify-between gap-3';
var I={grid:'<rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/>',chart:'<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',cpu:'<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>',bell:'<path d="M6 9a6 6 0 0112 0c0 6 2 7 2 7H4s2-1 2-7M10 20a2 2 0 004 0"/>',db:'<ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v12c0 1.7 3.6 3 8 3s8-1.3 8-3V6M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3"/>',set:'<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/>',out:'<path d="M9 4H5a1 1 0 00-1 1v14a1 1 0 001 1h4M16 8l4 4-4 4M20 12H9"/>',search:'<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',msg:'<path d="M4 5h16v11H9l-5 4z"/>',drop:'<path d="M12 3s6 6.5 6 11a6 6 0 11-12 0c0-4.5 6-11 6-11z"/>',gau:'<path d="M4 17a8 8 0 1116 0M12 17l4-5"/>'};
function ic(n){return '<svg class="ic" viewBox="0 0 24 24" aria-hidden="true">'+I[n]+'</svg>'}
var B='w-11 h-11 rounded-full grid place-items-center ';
document.getElementById('side').innerHTML=['grid','chart','cpu','bell','db'].map(function(n,i){return '<button aria-label="'+n+'" class="'+B+(i?'':'bg-dark text-white')+'">'+ic(n)+'</button>'}).join('')+
'<div class="hidden lg:block flex-1"></div><button aria-label="Pengaturan" class="'+B+'">'+ic('set')+'</button><button aria-label="Keluar" class="'+B+'">'+ic('out')+'</button><div class="'+B+'bg-gradient-to-br from-sea to-deep text-white font-bold text-[13px]">SW</div>';
[].forEach.call(document.querySelectorAll('[data-i]'),function(e){e.insertAdjacentHTML('afterbegin',ic(e.dataset.i))});

var P=[{n:'Suhu',u:'°C',b:28,a:3,now:29.4,d:1},{n:'Kelembapan',u:'%',b:80,a:8,now:84,d:0},{n:'Tekanan',u:'hPa',b:1009,a:2,now:1008.6,d:1},{n:'Hujan',u:'mm/jam',b:2,a:3,now:3.2,d:1,r:1},{n:'Angin',u:'km/jam',b:20,a:10,now:34,d:0,w:1}];
var N=168,s=7;function rnd(){s=(s*9301+49297)%233280;return s/233280}
P.forEach(function(p,j){p.v=[];for(var i=0;i<N;i++){var x=p.b+p.a*Math.sin(i/24*6.283-(j?0:2))+(rnd()-.5)*p.a*.6;if(p.r)x=Math.max(0,x-1.5);p.v.push(x)}p.v[N-1]=p.now});
function f(v,d){return v.toFixed(d).replace('.',',')}
function sp(v,c,w,h){var mn=Math.min.apply(0,v),mx=Math.max.apply(0,v);var pts=v.map(function(y,i){return (i/(v.length-1)*w).toFixed(1)+','+(h-3-(y-mn)/((mx-mn)||1)*(h-6)).toFixed(1)}).join(' ');return '<svg width="'+w+'" height="'+h+'" viewBox="0 0 '+w+' '+h+'" aria-hidden="true"><polyline points="'+pts+'" fill="none" stroke="'+c+'" stroke-width="2.5" stroke-linecap="round"/></svg>'}
function val(p){return '<div class="text-[26px] font-bold tracking-tight leading-tight">'+f(p.now,p.d)+'<small class="text-[13px] font-medium text-mute ml-1">'+p.u+'</small></div>'}
var K='<div class="text-mute text-[13.5px]">';
var CIRC='w-[46px] h-[46px] rounded-full bg-tint text-sea grid place-items-center shrink-0';
var bars=[40,70,55,85,60].map(function(h){return '<i class="w-1.5 rounded-[3px] bg-sea" style="height:'+h+'%"></i>'}).join('');
document.getElementById('stats').innerHTML=
'<div class="'+CARD+'"><div>'+K+'Suhu</div>'+val(P[0])+'</div><div class="flex gap-1.5 items-end h-11">'+bars+'</div></div>'+
'<div class="'+CARD+'"><div class="flex items-center gap-3"><div class="'+CIRC+'">'+ic('drop')+'</div><div>'+K+'Kelembapan</div>'+val(P[1])+'</div></div>'+sp(P[1].v.slice(-24),'var(--sea)',70,34)+'</div>'+
'<div class="'+CARD+'"><div class="flex items-center gap-3"><div class="'+CIRC+'">'+ic('gau')+'</div><div>'+K+'Tekanan udara</div>'+val(P[2])+'</div></div></div>'+
'<div class="'+CARD.replace('bg-card','bg-gradient-to-br from-sea to-deep text-white')+'"><div><div class="text-white/80 text-[13.5px]">Kecepatan angin</div>'+val(P[4]).replace('text-mute','text-white/80')+'</div>'+sp(P[4].v.slice(-24),'#fff',80,40)+'</div>';

var ps=document.getElementById('ps'),rs=document.getElementById('rs'),cur=0;
P.forEach(function(p,i){ps.insertAdjacentHTML('beforeend','<option value="'+i+'">'+p.n+'</option>')});
ps.onchange=function(){cur=+ps.value;draw()};rs.onchange=draw;
function draw(){
  var box=document.getElementById('cw'),W=box.clientWidth||600,H=box.clientHeight||160,rng=+rs.value,p=P[cur],v=p.v.slice(-rng),L=40,B=18,T=6,R=6;
  var mn=Math.min.apply(0,v),mx=Math.max.apply(0,v),pad=(mx-mn)*.1||1,lo=mn-pad,hi=mx+pad;
  var x=function(i){return L+i/(v.length-1)*(W-L-R)},y=function(a){return T+(1-(a-lo)/(hi-lo))*(H-T-B)};
  var o='',g,i;
  for(g=0;g<=3;g++){var val=lo+(hi-lo)*g/3,yy=y(val);o+='<line x1="'+L+'" x2="'+(W-R)+'" y1="'+yy+'" y2="'+yy+'" stroke="var(--line)"/><text x="'+(L-6)+'" y="'+(yy+3)+'" text-anchor="end">'+f(val,p.d)+'</text>'}
  var st=rng==24?4:24;for(i=0;i<v.length;i+=st){var bk=v.length-1-i;o+='<text x="'+x(i)+'" y="'+(H-3)+'" text-anchor="middle">'+(rng==24?'-'+bk+' j':'-'+Math.round(bk/24)+' h')+'</text>'}
  var q=v.map(function(a,k){return [x(k),y(a)]}),d='M'+q[0][0]+','+q[0][1];
  for(i=1;i<q.length-1;i++)d+=' Q'+q[i][0].toFixed(1)+','+q[i][1].toFixed(1)+' '+((q[i][0]+q[i+1][0])/2).toFixed(1)+','+((q[i][1]+q[i+1][1])/2).toFixed(1);
  d+=' L'+q[q.length-1][0]+','+q[q.length-1][1];
  o+='<defs><linearGradient id="gr" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="var(--sky)" stop-opacity=".45"/><stop offset="1" stop-color="var(--sky)" stop-opacity="0"/></linearGradient></defs><path d="'+d+' L'+(W-R)+','+(H-B)+' L'+L+','+(H-B)+'Z" fill="url(#gr)"/>';
  if(p.w){var ty=y(30);o+='<line x1="'+L+'" x2="'+(W-R)+'" y1="'+ty+'" y2="'+ty+'" stroke="var(--warn)" stroke-dasharray="5 4"/><text x="'+(W-R)+'" y="'+(ty-4)+'" text-anchor="end" style="fill:var(--warn)">batas waspada 30</text>'}
  o+='<path d="'+d+'" fill="none" stroke="var(--sea)" stroke-width="2.5"/>';
  var c=document.getElementById('chart');c.setAttribute('viewBox','0 0 '+W+' '+H);c.innerHTML=o;
  var av=v.reduce(function(a,b){return a+b},0)/v.length;
  document.getElementById('mx').textContent=f(mx,p.d);document.getElementById('mn').textContent=f(mn,p.d);document.getElementById('av').textContent=f(av,p.d);
}
draw();window.addEventListener('resize',draw);
})();
