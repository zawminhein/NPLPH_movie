import React from "react";
import { useState } from "react";

const Activities = ({translations, activityContent, activityBgImage, locale}) => {
    console.log(translations);
    const title = translations.activity_section_main_title;
    const subTitle = translations.activity_section_sub_title;
    
    const slides = [
        { src: "images/activities_section/activity1.jpg", alt: "Activity 1", title: "Blog title heading will go here" },
        { src: "images/activities_section/activity2.jpg", alt: "Activity 1", title: "Blog title heading will go here" },
        { src: "images/activities_section/activity3.jpg", alt: "Activity 1", title: "Blog title heading will go here" },
    ];

    const [current, setCurrent] = useState(0);

    // Move to next slide (only if not at last)
    const nextSlide = () => {
        if (current < slides.length - 1) {
            setCurrent((prev) => prev + 1);
        }
    };

    // Move to previous slide (only if not at first)
    const prevSlide = () => {
        if (current > 0) {
            setCurrent((prev) => prev - 1);
        }
    };
    return (
        <div>
            <section
                id="activities"
                className="relative py-16 mx-auto px-4 scroll-mt-24"
            >
                <div className="absolute inset-0">
                    <img
                        src={activityBgImage}
                        className="w-full h-full object-cover"
                        alt="Activities background"
                    />
                </div>

                {/* Content */}
                <div className="relative z-10 mx-6 md:ms-8 ">
                    <h3 className="text-[48px] font font-bold mb-14 text-left text-[#F24F00]">
                        {title}
                    </h3>

                    <h4 className="text-xl font-semibold mb-4 text-left text-black">
                        {subTitle}
                    </h4>

                    <div className="grid lg:grid-cols-2 gap-8">
                        {/* Left Column - Carousel */}
                        <div className="space-y-4">
                            <div className="overflow-hidden shadow-2xl relative rounded-xl">
                                <div
                                    className="flex transition-transform duration-500 ease-in-out"
                                    style={{
                                        transform: `translateX(-${
                                            current * 100
                                        }%)`,
                                    }}
                                >
                                    {slides.map((slide, index) => (
                                        <div
                                            key={index}
                                            className="w-full flex-shrink-0"
                                        >
                                            <img
                                                src={slide.src}
                                                className="w-full h-96 object-cover"
                                                alt={`Featured Activity ${
                                                    index + 1
                                                }`}
                                            />
                                        </div>
                                    ))}
                                </div>
                            </div>

                            {/* Featured Content */}
                            <div className="space-y-4">
                                <h5 className="text-xl font-semibold text-black">
                                    {slides[current].title}
                                </h5>
                                <a
                                    href="#"
                                    className="inline-flex items-center text-red-600 font-medium hover:text-orange-600 transition-colors"
                                >
                                    Read more &gt;
                                </a>
                            </div>

                            {/* Carousel Controls */}
                            <div className="flex gap-20 items-center mt-6">
                                <div className="flex space-x-4">
                                    <button
                                        onClick={prevSlide}
                                        disabled={current === 0}
                                        className={`w-12 h-12 flex items-center justify-center rounded-full border-2 text-2xl shadow-md transition-all
                                             ${ current === 0
                                                  ? "bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200"
                                                  : "bg-white hover:bg-gray-100 active:scale-95 text-red-600"}`
                                             }>
                                        <i className="fa-solid fa-arrow-left-long"></i>
                                    </button>

                                    <button
                                        onClick={nextSlide}
                                        disabled={current === slides.length - 1}
                                        className={`w-12 h-12 flex items-center justify-center rounded-full border-2 text-2xl shadow-md transition-all
                                             ${ current === slides.length - 1
                                                       ? "bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200"
                                                       : "bg-white hover:bg-gray-100 active:scale-95 text-red-600"}`
                                             }>
                                        <i className="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </div>

                                {/* Pagination Dots */}
                                <div className="flex space-x-2">
                                    {slides.map((_, index) => (
                                        <button
                                            key={index}
                                            onClick={() => setCurrent(index)}
                                            className={` w-3 h-3 rounded-full transition-all duration-300 ${
                                                index === current
                                                    ? "bg-red-600 scale-110"
                                                    : "bg-red-300 opacity-50 hover:opacity-80"
                                            }`}
                                        ></button>
                                    ))}
                                </div>
                            </div>
                        </div>

                        {/* Right Column - Smaller Activities */}
                        <div className="space-y-6 hidden lg:block">
                            {slides.map((slide, index) => (
                                <div key={index} className="flex space-x-4">
                                    <img
                                        src={slide.src}
                                        className="w-[220px] h-[240px] object-cover rounded-lg"
                                        alt={`Activity ${index + 1}`}
                                    />
                                    <div className="flex-1 flex flex-col justify-center">
                                        <h5 className="text-lg font-semibold text-black mb-2">
                                            {slide.title}
                                        </h5>
                                        <a
                                            href="#"
                                            className="inline-flex items-center text-red-600 font-medium hover:text-orange-600 transition-colors"
                                        >
                                            Read more &gt;
                                        </a>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
};

export default Activities;
