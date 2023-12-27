<script lang="ts">
  import { name } from "../store";
</script>

<div class="container">
  <h1>Hello {$name}</h1>

  <input type="text" bind:value={$name} />
</div>
