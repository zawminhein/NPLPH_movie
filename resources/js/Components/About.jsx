import React, { useState, useEffect } from 'react';

const About = ({ translations, aboutContent, locale }) => {
  // console.log(aboutContent.image_url);
  
  // ✅ Safely get images (handles both resource collection or array)
  const images = aboutContent.image_url?.data || aboutContent.image_url || [];

  const title = translations.about_section_title;
  const desc = locale === "mm" ? aboutContent.desc_mm : aboutContent.desc_en;

  const [currentIndex, setCurrentIndex] = useState(0);

  const bgImage = aboutContent.bg_image_url;

  // ✅ Handlers for buttons
  const handlePrev = () => {
    if (images.length === 0) return;
    setCurrentIndex((prevIndex) =>
      prevIndex === 0 ? images.length - 1 : prevIndex - 1
    );
  };

  const handleNext = () => {
    if (images.length === 0) return;
    setCurrentIndex((prevIndex) =>
      prevIndex === images.length - 1 ? 0 : prevIndex + 1
    );
  };

  // ✅ Optional auto-slide (every 5s)
  useEffect(() => {
    if (images.length === 0) return;
    const interval = setInterval(() => {
      setCurrentIndex((prev) => (prev + 1) % images.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [images]);

  return (
    <div>
      <section
        id="about"
        className="relative flex items-center justify-center py-16 scroll-mt-24 h-[880px] max-w-[1920px]"
      >
        {/* Background Image */}
        <div className="absolute inset-0">
          <img
            src={bgImage}
            className="w-full h-full object-cover"
            alt="About background"
          />
        </div>

        {/* Content */}
        <div className="relative mx-6 md:ms-8 px-4 grid md:grid-cols-2 gap-8 items-center">
          {/* Text Section */}
          <div>
            <h3 className="font text-[36px] font-bold mb-4 text-[#E56B60]">
              {title}
            </h3>
            <p className="text-dark-100 leading-relaxed">{desc}</p>
          </div>

          {/* Image Slideshow Section */}
          <div className="relative md:me-14">
            {/* Carousel Container */}
            <div className="overflow-hidden rounded-lg shadow-md">
              <div
                className="flex transition-transform duration-700 ease-in-out"
                style={{
                  transform: `translateX(-${currentIndex * 100}%)`,
                }}
              >
                {images.map((img, index) => (
                  <img
                    key={index}
                    src={img.path}
                    alt={`Image ${index}`}
                    className="w-full flex-shrink-0"
                  />
                ))}
              </div>
            </div>

            {/* Controls Row */}
            <div className="flex justify-between items-center mt-4">
              {/* Prev / Next Buttons (left side) */}
              <div className="flex space-x-4">
                <button
                  onClick={handlePrev}
                  className="w-12 h-12 flex items-center justify-center rounded-full border-2 border-red-500
                   bg-white text-2xl font-bold shadow-md hover:bg-gray-100 transition"
                >
                  <i className="fa-solid fa-arrow-left-long text-red-500"></i>
                </button>
                <button
                  onClick={handleNext}
                  className="w-12 h-12 flex items-center justify-center rounded-full border-2 border-red-500
                   bg-white text-2xl font-bold shadow-md hover:bg-gray-100 transition"
                >
                  <i className="fa-solid fa-arrow-right-long text-red-500"></i>
                </button>
              </div>

              {/* Pagination Dots (right side) */}
              <div className="flex space-x-2">
                {images.map((_, index) => (
                  <button
                    key={index}
                    onClick={() => setCurrentIndex(index)}
                    className={`w-3 h-3 rounded-full transition-all ${
                      index === currentIndex
                        ? "bg-red-500 scale-125"
                        : "bg-red-300"
                    }`}
                  ></button>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Bottom Line */}
      <div className="border-t-2 border-red-600 w-full"></div>
    </div>
  );
};

export default About;
