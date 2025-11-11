import React from 'react'

const Upcoming = ({translations, upcomingContent, locale}) => {

    // console.log(upcomingContent);
    const bgImage = upcomingContent.bg_image_url;
    const image = upcomingContent.image_url;
    const title = translations.upcoming_section_title;
    const shortDesc = locale === 'mm' ? upcomingContent.short_desc_mm : upcomingContent.short_desc_en;
    const longDesc = locale === 'mm' ? upcomingContent.long_desc_mm : upcomingContent.long_desc_en;

    return (
        <div>
            <section id="upcoming" className="relative py-16 scroll-mt-24">
                <div className="absolute inset-0">
                <img src={bgImage} alt="Upcoming background" 
                    className='w-full h-full object-cover'/>
                </div>

                {/* <!-- Content --> */}
                <div className="relative mx-6 md:ms-8 px-4 grid md:grid-cols-2 gap-8 items-center">
                    
                    {/* <!-- Text Section --> */}
                    <div className="flex flex-col order-1 md:order-2">
                        <h3 className="font text-[36px] font-bold mb-2 text-[#E56B60]">{title}</h3>
                        <h5 className="text-[18px] font font-bold mb-4 text-[#E76B5F]">{shortDesc}</h5>

                        {/* <!-- Image (will move here on mobile) --> */}
                        <div className="rounded-lg shadow-md mb-4 block md:hidden">
                            <img src={image} alt="Upcoming" className='w-full rounded-lg'/>
                        </div>

                        {/* <!-- Paragraph --> */}
                        <p className="text-dark-100 me-16 leading-relaxed">
                            {longDesc}
                        </p>
                    </div>

                    {/* <!-- Image Section (hidden on mobile, visible on desktop) --> */}
                    <div className="relative hidden md:block order-2 md:order-1">
                        <div className="rounded-lg shadow-md">
                            <img src={image} alt="Upcoming" className='w-full rounded-lg'/>
                        </div>
                    </div>
                </div>
            </section>
            <hr className='border-t-2 border-red-500'/>
        </div>
    )
}

export default Upcoming