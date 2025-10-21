import React, { useState } from 'react'
import MobileSidebar from './MobileSidebar';

const Header = () => {

    const [isOpen, setIsOpen] = useState(false);

    return (
        <div>
            <header className="fixed w-full bg-white shadow-md z-50">
                <div className="max-w-[1920px] mx-auto px-12 py-3 flex items-center justify-between">
                    {/* <!-- Logo --> */}
                    <a
                        href="#home"
                        className="font text-2xl sm:text-3xl lg:text-[35px] font-bold tracking-tight"
                    >
                        NGAPYANLARPYIHYAE
                    </a>

                    {/* <!-- Desktop Nav --> */}
                    <nav
                        className="hidden px-12 lg:flex items-center gap-12 xl:gap-20 text-base lg:text-xl font-bold"
                    >
                        <a href="#about" className="nav-link font-[inter] hover:text-red-300 transition-colors">ABOUT</a>
                        <a href="#shorts" className="nav-link font-[inter] hover:text-red-300 transition-colors">SHORTS</a>
                        <a href="#gallery" className="nav-link font-[inter] hover:text-red-300 transition-colors">GALLERY</a>
                        <a href="#contacts" className="nav-link font-[inter] hover:text-red-300 transition-colors">CONTACTS</a>
                    </nav>

                    {/* Mobile Menu Button */}
                    <button onClick={() => setIsOpen(!isOpen)} className="lg:hidden text-2xl" aria-label="Open menu">
                        <i className="fa-solid fa-bars"></i>
                    </button>
                </div>

                {/* Mobile slidebar */}
                <MobileSidebar isOpen={isOpen} onClose={() => setIsOpen(false)}/>

                <hr className="border-t-2 border-red-600"/>
            </header>
        </div>
    )
}

export default Header;