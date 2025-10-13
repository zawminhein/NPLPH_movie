import React from 'react'
import { usePage, Link } from '@inertiajs/react'

const Hero = () => {
  const { props } = usePage()
  const heroContent = props.heroContent || null
  const locale = props.locale === 'en' ? 'en' : 'mm'

  if (!heroContent) {
    return (
      <div className="max-w-5xl mx-auto py-16 px-4">
        <div className="text-gray-500">No hero content available.</div>
      </div>
    )
  }

  const title = locale === 'mm' ? heroContent.title_mm : heroContent.title_en
  const shortDesc = locale === 'mm' ? heroContent.short_desc_mm : heroContent.short_desc_en
  const longDesc = locale === 'mm' ? heroContent.long_desc_mm : heroContent.long_desc_en

  return (
    <section className="pt-28 pb-16 bg-white">
      <div className="max-w-5xl mx-auto px-4">
        <div className="flex items-start justify-between gap-6">
          <div>
            <h1 className="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
              {title}
            </h1>
            {shortDesc && (
              <p className="mt-4 text-lg text-gray-600">{shortDesc}</p>
            )}
            {longDesc && (
              <p className="mt-6 text-base text-gray-700 leading-7">{longDesc}</p>
            )}
          </div>

          <div className="shrink-0 flex flex-col gap-2 items-end">
            <span className="text-sm text-gray-500">Language</span>
            <div className="inline-flex rounded border border-gray-300 overflow-hidden">
              <Link href="/set-locale/en" className={`px-3 py-1 text-sm ${locale === 'en' ? 'bg-gray-900 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'}`}>EN</Link>
              <Link href="/set-locale/mm" className={`px-3 py-1 text-sm ${locale === 'mm' ? 'bg-gray-900 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'}`}>MM</Link>
            </div>
          </div>
        </div>

        {heroContent.image_url && (
          <div className="mt-10">
            <img src={heroContent.image_url} alt="Hero" className="w-full h-auto rounded-lg shadow" />
          </div>
        )}
      </div>
    </section>
  )
}

export default Hero