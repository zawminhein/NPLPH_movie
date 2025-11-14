import React, { createContext, useContext } from 'react';

const TranslationContext = createContext();

export const TranslationProvider = ({ translations, locale, children }) => {
  return (
    <TranslationContext.Provider value={{ translations, locale }}>
      {children}
    </TranslationContext.Provider>
  );
};

export const useTranslation = () => useContext(TranslationContext);
