<template>
  <div class="footer">
    <div>Powered by Adizbek/Larabek</div>
    <div>
      Github <a target="_blank" href="https://github.com/adizbek">@adizbek</a>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Footer"
  }
</script>

<style scoped lang="scss">
  .footer {
    padding: 4px 8px;
    font-size: 13px;
    border-top: 1px solid darken(#fff, 10%);
    background: #ffffff;
    margin-left: var(--sidebar-width);
  }
</style>
