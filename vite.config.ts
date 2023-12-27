/* eslint-disable n/no-path-concat */
import { defineConfig, loadEnv, ServerOptions, UserConfig } from 'vite'
import { resolve } from 'node:path'
import { svelte } from '@sveltejs/vite-plugin-svelte'
import { homedir } from 'os'
import * as fs from 'fs'
import liveReload from 'vite-plugin-live-reload'
import sassGlobImports from 'vite-plugin-sass-glob-import'
import stylelint from 'vite-plugin-stylelint'
import postcssPresetEnv from 'postcss-preset-env'
import tailwindcss from 'tailwindcss'

function detectServerConfig(host: null | string) {
  const keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`)
  const certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`)

  if (!fs.existsSync(keyPath)) {
    return {
      cors: true
    }
  }

  if (!fs.existsSync(certificatePath)) {
    return {
      cors: true
    }
  }

  return {
    cors: true,
    hmr: { host },
    host,
    strictPort: true,
    port: 5173,
    https: {
      key: fs.readFileSync(keyPath),
      cert: fs.readFileSync(certificatePath)
    }
  }
}

// @ts-ignore
export default defineConfig(({ command, mode }) => {
  const root = './wp-content/themes/socialbrothers/src'
  const env = loadEnv(mode, process.cwd(), '')
  const host = new URL(env.APP_URL).host
  const homeDir = homedir()

  let serverConfig: ServerOptions = {}

  if (homeDir) {
    serverConfig = detectServerConfig(host)
  }

  const userConfig: UserConfig = {
    root,
    build: {
      outDir: '../dist',
      emptyOutDir: true,
      manifest: true,
      copyPublicDir: false,
      rollupOptions: {
        input: [resolve(root, '/main.ts'), resolve(root, '/backend.ts')]
      }
    },
    plugins: [
      svelte({ configFile: __dirname + '/svelte.config.js' }),
      sassGlobImports(),
      stylelint(),
      liveReload([
        __dirname + '/wp-content/themes/socialbrothers/**/*.php',
        __dirname + '/wp-content/themes/socialbrothers/**/*.html',
        __dirname + '/wp-content/themes/socialbrothers/**/*.twig'
      ])
    ],
    resolve: {
      dedupe: ['svelte']
    },
    server: {
      cors: true
    },
    css: {
      postcss: {
        plugins: [
          tailwindcss,
          postcssPresetEnv
        ]
      }
    }
  }

  userConfig.base = mode === 'development'
    ? '/'
    : '/wp-content/themes/socialbrothers/dist'
  userConfig.server = serverConfig

  return userConfig
})
