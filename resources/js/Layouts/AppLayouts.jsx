import React from 'react'
import Header from '../Components/Header'
import Footer from '../Components/Footer'
import { TranslationProvider } from '../Contexts/TranslationContext';

const AppLayouts = ({children, footerBgImage, translations, locale}) => {
  console.log(translations);
  
  return (
    <TranslationProvider translations={translations} locale={locale}>
      <div>
        <Header />
        <main>{children}</main>
        <Footer footerBgImage={footerBgImage} />
      </div>
    </TranslationProvider>
  )
}

export default AppLayouts