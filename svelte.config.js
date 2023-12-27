import sveltePreprocess from 'svelte-preprocess'
import { vitePreprocess } from '@sveltejs/vite-plugin-svelte'

export default {
  // Consult https://svelte.dev/docs#compile-time-svelte-preprocess
  // for more information about preprocessors
  compilerOptions: {
    enableSourcemap: true
  },
  preprocess: [
    vitePreprocess({
      postcss: true,
      sourceMap: true
    }),
    sveltePreprocess()
  ]
}
