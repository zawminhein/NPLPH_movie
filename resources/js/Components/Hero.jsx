import React, { useEffect, useState } from 'react'
import { Link } from '@inertiajs/react'

const Hero = ({ translations, heroContent, locale }) => {

  const [bgImage, setBgImage] = useState('/images/hero_section/hero_section_banner1.png')

  useEffect(() => {
    if(heroContent?.image_url)
    {
      fetch(heroContent.image_url, { method: 'HEAD' })
        .then((res) => {
          if (res.ok) {
            setBgImage(heroContent.image_url)
          } else {
            setBgImage('/images/hero_section/hero_section_banner1.png')
          }
        }) 
        .catch(() => {
          setBgImage('/images/hero_section/hero_section_banner1.png')
        });
    }
  }, [heroContent]);

  if (!heroContent) {
    return (
      <div className="max-w-5xl mx-auto py-16 px-4">
        <div className="text-gray-500">No hero content available.</div>
      </div>
    )
  }

  const title = translations.hero_section_title
  const shortDesc = locale === 'mm' ? heroContent.short_desc_mm : heroContent.short_desc_en
  const longDesc = locale === 'mm' ? heroContent.long_desc_mm : heroContent.long_desc_en
  // const imageUrl = heroContent.image_url || '/images/hero_section/hero_section_banner1.png'

  return (
    <section
      className="relative w-full bg-cover bg-center bg-no-repeat h-[1152px]"
      style={{ backgroundImage: `url(${bgImage})` }}
    >
      <div className="bg-black/50 w-full h-full absolute top-0 left-0"></div> {/* Overlay */}

      <div className="absolute inset-0 flex flex-col items-center justify-center text-center gap-6 px-4">
        <h1 className="font-bold text-[#FEF3C6] text-[35px] sm:text-5xl md:text-6xl mt-6 drop-shadow-lg">
          {title}
        </h1>

        <hr className='border-t-4 border-[#FFB900] w-20 rounded-full mt-2' />

        {shortDesc && (
          <p className="text-lg text-[#FEE685] [font-size:19.52px] sm:text-lg max-w-2xl">{shortDesc}</p>
        )}

        {longDesc && (
          <p className="text-base sm:text-lg text-gray-300 max-w-2xl leading-relaxed">
            {longDesc}
          </p>
        )}

        <div className="flex items-center justify-center">
          <img
            src="/images/hero_section/Kanote.svg"
            alt="Left Kanote"
            className="w-[45px] h-[47px]"
          />
          <Link
            href="#explore"
            className="bg-[#F24F01] w-[152px] h-[45px] rounded-md text-white hover:bg-[#d94301] px-6 py-3 transition text-center"
          >
            Explore Now !
          </Link>
          <img
            src="/images/hero_section/Kanote1.svg"
            alt="Right Kanote"
            className="w-[45px] h-[47px]"
          />
        </div>
      </div>

      <div className="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <img src="/images/hero_section/mouse.png" alt="Mouse" className="w-10 h-10" />
      </div>
    </section>
  )
}

export default Hero
