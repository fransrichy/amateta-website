    </main>
  </div>
</div>
<div class="adm-overlay" id="admOverlay" onclick="admToggleSidebar(false)"></div>
<script>
function admToggleSidebar(force) {
  var sb = document.getElementById('sidebar'), ov = document.getElementById('admOverlay');
  var open = (typeof force === 'boolean') ? force : !sb.classList.contains('open');
  sb.classList.toggle('open', open);
  ov.classList.toggle('show', open);
}
// Close the menu after tapping a link (mobile)
document.querySelectorAll('.sidebar-nav a, .sidebar-foot a').forEach(function (a) {
  a.addEventListener('click', function () { if (window.innerWidth <= 760) admToggleSidebar(false); });
});
// Confirm delete / destructive actions
document.querySelectorAll('form[data-confirm]').forEach(function (f) {
  f.addEventListener('submit', function (e) { if (!confirm(f.getAttribute('data-confirm'))) e.preventDefault(); });
});
</script>
</body>
</html>
