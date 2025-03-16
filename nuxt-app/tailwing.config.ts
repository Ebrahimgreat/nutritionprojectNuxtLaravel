import type { Config } from 'tailwindcss'

export default <Partial<Config>>{
  theme: {
    extend: {
      colors:{
        primary:{
          700:"black"
        }
      },
      aspectRatio: {
        auto: 'auto',
        square: '1 / 1',
        video: '16 / 9'
      }
    }
  }
}