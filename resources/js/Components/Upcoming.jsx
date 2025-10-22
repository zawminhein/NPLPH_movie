import React from 'react'

const Upcoming = () => {
  return (
    <div>
        <section id="upcoming" className="relative py-16 scroll-mt-24">
            <div className="absolute inset-0">
               <img src="images/upcoming_section/upcoming_banner1.png" alt="Upcoming background" 
                    className='w-full h-full object-cover'/>
            </div>

            {/* <!-- Content --> */}
            <div className="relative mx-6 md:ms-8 px-4 grid md:grid-cols-2 gap-8 items-center">
                
                {/* <!-- Text Section --> */}
                <div className="flex flex-col order-1 md:order-2">
                    <h3 className="font text-[36px] font-bold mb-2 text-[#E56B60]">Upcoming Season</h3>
                    <h5 className="text-[18px] font font-bold mb-4 text-[#E76B5F]">What awaits in future untold?</h5>

                    {/* <!-- Image (will move here on mobile) --> */}
                    <div className="rounded-lg shadow-md mb-4 block md:hidden">
                         <img src="/images/upcoming_section/upcoming_banner2.jpg" alt="Upcoming" className='w-full rounded-lg'/>
                    </div>

                    {/* <!-- Paragraph --> */}
                    <p className="text-dark-100 me-16 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Molestiae eveniet ad recusandae quasi facilis similique iste, 
                        nostrum, labore consectetur aliquam repudiandae nesciunt ullam saepe cumque? 
                        Eum, nihil enim? Ut impedit illo, voluptate odio quis aliquam dolor facilis est 
                        laborum quam maiores atque nihil natus aspernatur velit minus voluptatum.
                    </p>
                </div>

                {/* <!-- Image Section (hidden on mobile, visible on desktop) --> */}
                <div className="relative hidden md:block order-2 md:order-1">
                    <div className="rounded-lg shadow-md">
                         <img src="/images/upcoming_section/upcoming_banner2.jpg" alt="Upcoming" className='w-full rounded-lg'/>
                    </div>
                </div>
            </div>
        </section>
        <hr className='border-t-2 border-red-500'/>
    </div>
  )
}

export default Upcoming