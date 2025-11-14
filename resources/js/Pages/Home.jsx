import React from 'react'
import AppLayouts from '../Layouts/AppLayouts'
import Hero from '../Components/Hero'
import About from '../Components/About'
import Shorts from '../Components/Shorts'
import Upcoming from '../Components/Upcoming'
import Activities from '../Components/Activities'
import Contact from '../Components/Contact'

export default function Home({ 
    translations, heroContent, aboutContent, shortContent, upcomingContent, activityContent, activityBgImage, contactContent, footerBgImage, locale 
  }) 
{
  return (
    <AppLayouts translations={translations} locale={locale} footerBgImage={footerBgImage}>
      <Hero  heroContent={heroContent}/>
      <About translations={translations} aboutContent={aboutContent} locale={locale} />
      <Shorts translations={translations} shortContent={shortContent} locale={locale} />
      <Upcoming translations={translations} upcomingContent={upcomingContent} locale={locale} />
      <Activities translations={translations} activityContent={activityContent} activityBgImage={activityBgImage} locale={locale} />
      <Contact translations={translations} contactContent={contactContent} locale={locale} />
    </AppLayouts>
  )
}
