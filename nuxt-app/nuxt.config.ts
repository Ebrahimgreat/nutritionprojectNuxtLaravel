// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',

  devtools: { enabled: true },
    app:{
      pageTransition:{
          name:'fade',

      },
      
    },
    ui:{
      primary:'green',
      gray:'cool'
    },
   


  modules: [
    '@nuxt/ui',
    '@pinia/nuxt',
    'shadcn-nuxt',
    '@nuxt/fonts',
  
    '@prisma/nuxt',
    '@nuxtjs/storybook',
    
  ],
  
  




})