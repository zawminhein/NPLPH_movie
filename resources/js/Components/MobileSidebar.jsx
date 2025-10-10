import React from 'react'

const MobileSidebar = ({isOpen, onClose}) => {
  return (
    <div>
        <div className={`fixed inset-0 bg-black/50 z-[55] transition-opacity duration-300 ${
          isOpen ? "opacity-100 visible" : "opacity-0 invisible"
        }`}
        onClick={onClose}
        ></div>

        {/* Sidebar */}
        <aside
            className={`fixed top-0 right-0 h-full w-72 max-w-[85vw] bg-[#5b220d] text-[#f3c98b] z-[60] p-5 flex flex-col transform transition-transform duration-300 ${
            isOpen ? "translate-x-0" : "translate-x-full"
            }`}
        >
            {/* Header */}
            <div className="flex items-center justify-between mb-6">
                <div>
                    <div className="text-sm">Movie</div>
                    <div className="text-2xl font-extrabold tracking-wide leading-tight">
                    NGARPYANLAR
                    <br />
                    PYIHYAE
                    </div>
                </div>

                <button
                    onClick={onClose}
                    className="bg-white text-xl text-[#5b220d] rounded-md p-1 w-6 h-6 shadow-md flex items-center justify-center"
                    aria-label="Close menu"
                >
                    <i className="fa-solid fa-minus"></i>
                </button>
            </div>

            {/* Navigation Links */}
            <nav className="space-y-5 text-white/90 font-semibold">
            <a href="#home" className="block hover:text-yellow-300" onClick={onClose}>
                Home
            </a>
            <a href="#about" className="block hover:text-yellow-300" onClick={onClose}>
                About
            </a>
            <a href="#shorts" className="block hover:text-yellow-300" onClick={onClose}>
                Shorts
            </a>
            <a href="#activities" className="block hover:text-yellow-300" onClick={onClose}>
                Activities
            </a>
            <a href="#contacts" className="block hover:text-yellow-300" onClick={onClose}>
                Contact Us
            </a>
            <div className="h-px bg-white/20 my-3"></div>
            <a href="#" className="block text-white/80 hover:text-yellow-300">
                Privacy Policy
            </a>
            <a href="#" className="block text-white/80 hover:text-yellow-300">
                Terms of Use
            </a>
            </nav>
        </aside>
    </div>
  )
}

export default MobileSidebar;