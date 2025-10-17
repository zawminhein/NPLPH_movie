import React from 'react'
import AppLayouts from '../Layouts/AppLayouts'
import Hero from '../Components/Hero'

export default function Home({ translations, heroContent, locale }) {
  console.log('Home props:', { translations, heroContent, locale });

  return (
    <AppLayouts>
      <Hero translations={translations} heroContent={heroContent} locale={locale} />
    </AppLayouts>
  )
}
