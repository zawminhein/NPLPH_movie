import React from 'react'

const Shorts = ({translations, shortContent, locale}) => {

     const bgImage = shortContent.image_url;
     // console.log(shortContent);

     const title = translations.hero_section_title;
     const subTitle = locale === 'mm' ? shortContent.title_mm : shortContent.title_en;
     const desc = locale === 'mm' ? shortContent.desc_mm : shortContent.desc_en;
     
     return (
          <div>
               <section id="shorts" className="relative py-16 scroll-mt-24">
                    <div className="absolute inset-0">
                         <img src={bgImage} className="w-full h-full object-cover" />
                    </div>

                    {/* <!-- Content --> */}
                    <div className="relative px-4 mx-6 md:ms-8 grid md:grid-cols-2 gap-4 items-start">

                         {/* <!-- Left column --> */}
                         <div className="px-0 flex flex-col">
                              <h3 className="text-2xl font font-bold mb-8 text-[#E76B5F]">{title}</h3>
                              <h5 className="text-[18px] font font-bold mb-4 text-[#E76B5F]">{subTitle}</h5>

                              {/* <!-- Video on mobile only --> */}
                              <div className="md:hidden mb-4">
                                   <div className="aspect-video rounded-lg overflow-hidden shadow-md max-w-2xl mx-auto my-6">
                                        <iframe
                                             src="https://www.youtube.com/embed/QoPZk28adMY?si=4v9zJFkEwrKsd1fO"
                                             title="YouTube video player"
                                             allowFullScreen
                                             className="w-full h-full"
                                        ></iframe>
                                   </div>
                              </div>

                              <p className="text-[#F54900] leading-relaxed mb-4">
                                   {desc}
                              </p>
                              <div className="inline-flex mt-2 justify-center w-full md:justify-start">
                                   <img src="images/shorts_section/Kanote.svg" alt="Ornament Left" className="w-[45px] h-[47px]" />
                                   <a href="#" className="inline-block w-max bg-orange-500 px-6 py-2 rounded-md text-white hover:bg-orange-600">
                                        Watch Now !
                                   </a>
                                   <img src="images/shorts_section/Kanote1.svg" alt="Ornament Right" className="w-[45px] h-[47px]" />
                              </div>
                         </div>

                         {/* <!-- Right column (desktop video) --> */}
                         <div className="relative md:me-16 hidden md:block "> 
                              <div className="aspect-video rounded-lg overflow-hidden shadow-md mx-auto my-6">
                                   <iframe
                                        src="https://www.youtube.com/embed/QoPZk28adMY?si=4v9zJFkEwrKsd1fO"
                                        title="YouTube video player"
                                        allowFullScreen
                                        className="w-full h-full"
                                   ></iframe>
                              </div> 
                         </div>
                    </div>
               </section>
               <hr className='border-t-2 border-red-500'/>
          </div>
     )
}

export default Shorts