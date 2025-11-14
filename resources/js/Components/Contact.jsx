import React from 'react'

const Contact = ({translations, contactContent, locale}) => {

    console.log(contactContent);

    const title = translations.contact_us_section_title;
    const desc = locale === 'en' ? contactContent.desc_en : contactContent.desc_mm;
    
    const bgImage = contactContent.image_url;  
    const mail = contactContent.mail;
    const phone = contactContent.phone;
    const address = contactContent.address;

    return (
        <div>
        <section id="contacts" className="relative bg-gray-900 text-white py-16 scroll-mt-24">
                {/* <!-- Background Image --> */}
                <div className="absolute inset-0">
                    <img
                    src={bgImage}
                    className="w-full h-full object-cover opacity-80"
                    alt="Hero background"
                    />
                </div>

                {/* <!-- Contact Card --> */}
                <div
                    className="relative mx-4 sm:mx-auto max-w-md md:max-w-lg lg:max-w-xl bg-gray-100 rounded-2xl shadow-lg p-8 md:p-10 my-8"
                >
                    <h2 className="text-[48px] font font-bold text-black mb-4 md:text-left">
                    {title}
                    </h2>
                    <p className="text-gray-700 mb-6 md:text-left">
                    {desc}
                    </p>

                    <div className="space-y-5">
                        <div className="flex items-center space-x-3">
                            <i className="fa-regular fa-envelope text-[#F24F01] text-xl"></i>
                            <span className="text-gray-800 break-all">{mail}</span>
                        </div>

                        <div className="flex items-center space-x-3">
                            <i className="fa-solid fa-phone text-[#F24F01] text-xl"></i>
                            <span className="text-gray-800">{phone}</span>
                        </div>

                        <div className="flex items-start space-x-3">
                            <i className="fa-solid fa-location-dot text-[#F24F01] text-xl mt-1"></i>
                            <span className="text-gray-800">
                                {address}
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default Contact