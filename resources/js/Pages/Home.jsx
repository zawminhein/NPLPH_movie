import React from 'react'
import AppLayouts from '../Layouts/AppLayouts'
import Hero from '../Components/Hero'
import About from '../Components/About'
import Shorts from '../Components/Shorts'
import Upcoming from '../Components/Upcoming'
import Activities from '../Components/Activities'

export default function Home({ translations, about_translations, heroContent, aboutContent, locale }) {
  console.log('Home props:', { translations, about_translations , aboutContent, heroContent, locale });

  return (
    <AppLayouts>
      <Hero translations={translations} heroContent={heroContent} locale={locale} />
      <About translations={about_translations} aboutContent={aboutContent} locale={locale} />
      <Shorts translations={translations} locale={locale} />
      <Upcoming translations={translations} locale={locale} />
      <Activities translations={translations} locale={locale} />
    </AppLayouts>
  )
}
