<x-dashboard.layout>
  <div class="home">
    <h2>Selamat datang di dashboard admin, <span title="nama admin" style="color: var(--main-color);">{{ auth()->user()->username ?? '' }}</span></h2>
  </div>
</x-dashboard.layout>