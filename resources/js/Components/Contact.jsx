import React from 'react'

const Contact = () => {
  return (
    <div>
     <section id="contacts" className="relative bg-gray-900 text-white py-16 scroll-mt-24">
            {/* <!-- Background Image --> */}
            <div className="absolute inset-0">
                <img
                src="images/contact_section/Contact Us.png"
                className="w-full h-full object-cover opacity-80"
                alt="Hero background"
                />
            </div>

            {/* <!-- Contact Card --> */}
            <div
                className="relative mx-4 sm:mx-auto max-w-md md:max-w-lg lg:max-w-xl bg-gray-100 rounded-2xl shadow-lg p-8 md:p-10 my-8"
            >
                <h2 className="text-[48px] font font-bold text-black mb-4 md:text-left">
                Contact us
                </h2>
                <p className="text-gray-700 mb-6 md:text-left">
                Our friendly team would love to hear from you.
                </p>

                <div className="space-y-5">
                    <div className="flex items-center space-x-3">
                         <i className="fa-regular fa-envelope text-[#F24F01] text-xl"></i>
                         <span className="text-gray-800 break-all">ngarpyanlarpyihyae@gmail.com</span>
                    </div>

                    <div className="flex items-center space-x-3">
                         <i className="fa-solid fa-phone text-[#F24F01] text-xl"></i>
                         <span className="text-gray-800">+959 432225112</span>
                    </div>

                    <div className="flex items-start space-x-3">
                         <i className="fa-solid fa-location-dot text-[#F24F01] text-xl mt-1"></i>
                         <span className="text-gray-800">
                         23/5 Thirimingalar Ave, Yankin Township, Myanmar.
                         </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
  )
}

export default Contact