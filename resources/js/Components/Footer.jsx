import React from 'react'

const Footer = () => {
  return (
    <div>
      <footer className="relative py-10 px-6 text-[#ffdca8]">
            {/* <!-- Background image --> */}
            <div className="absolute inset-0">
                <img src="images/footer_section/Footer.png" alt="Footer background" className="w-full h-full object-cover"/>
            </div>

            {/* <!-- Content wrapper --> */}
            <div className="relative z-10 mx-6 flex flex-col md:flex-row justify-between gap-8">

                {/* <!-- Movie section (left section on desktop, first on mobile) --> */}
                <div className="md:w-2/3 order-1">
                    <h1 className="text-[22px] font font-bold text-[#FEE685]">Movie</h1>
                    <h1 className="text-[24px] font sm:text-[35px] break-words font-bold text-[#FFB86A] mt-1">NGARPYANLARPYIHYAE</h1>
                    <p className="text-sm mt-3 text-[#FEE685] italic">
                        A handcrafted collection of cinematic masterpieces, 
                        curated with love and passion for the art of filmmaking.
                    </p>
                    {/* <!-- Decorative divider --> */}
                    <div className="flex items-center gap-4 mt-6 text-[#f2c46d]">
                        <span className="h-px w-10 bg-[#f2c46d]"></span>
                        <i className="fa-solid fa-asterisk text-sm"></i>
                        <span className="h-px w-10 bg-[#f2c46d]"></span>
                    </div>
                    <p className="text-xs mt-4 text-[#FFD230]">Est. 2025 • Development with Min Shin Saw</p>
                </div>

                {/* <!-- Connect section (right section on desktop, second on mobile) --> */}
                <div className="md:w-1/3 flex flex-col md:pr-12 md:items-end order-2">
                    <h3 className="text-[18px] font font-bold text-[#FEE685] mb-6">Connect</h3>
                    <p className="mb-4">
                        <a href="mailto:ngarpynlarpyihyae@gmail.com" className="inline text-[#FEE685] text-sm hover:underline">
                          <i className="fas fa-envelope text-white text-xs mr-2"></i>
                          ngarpynlarpyihyae@gmail.com
                        </a>
                    </p>
                    <p className="text-sm text-[#FEE685]">
                        <i className="fa-solid fa-map-pin"></i>
                        23/5 Thirimingalar Ave, Yankin Township, Myanmar
                    </p>
                </div>
            </div>

            {/* <!-- Bottom Section --> */}
            <div className="relative z-10 mt-10 text-center text-xs text-[#FFD230] space-y-2">
                <p className="italic">"Cinema is a matter of what's in the frame and what's out." – Martin Scorsese</p>
                <p>
                    <a href="#" className="hover:underline">Privacy Policy</a> <span className="mx-4">•</span>
                    <a href="#" className="hover:underline">Terms of Use</a> <span className="mx-4">•</span>
                    © 2025 Ngarpyanlarpyihyae
                </p>
            </div>
        </footer>
    </div>
  )
}

export default Footer