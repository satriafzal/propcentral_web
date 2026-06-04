<div id="contactModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeContact()"></div>

    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        
        <form action="https://formspree.io/f/xgobeggl" method="POST" target="_blank" class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg w-full">
            
            <button type="button" onclick="closeContact()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <div class="bg-white px-8 pt-8 pb-8">
                <div class="text-center mb-6">
                    <h3 class="text-2xl leading-6 font-extrabold text-gray-900 mb-2">Do You Have Any Questions?</h3>
                    <p class="text-sm text-gray-500">Subscribe to our newsletter and stay updated on the latest properties and offers.</p>
                </div>
                
                <div class="mt-4">
                    <input type="email" name="email" required placeholder="Enter your email..." class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition-all duration-300 shadow-sm mb-4">
                    
                    <textarea name="message" placeholder="Enter your message (optional)..." rows="3" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 focus:outline-none transition-all duration-300 shadow-sm"></textarea>
                </div>
            </div>
            
            <div class="bg-gray-50 px-8 py-4 sm:flex sm:flex-row-reverse border-t border-gray-100">
                <button type="submit" onclick="setTimeout(() => closeContact(), 500)" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-gray-900 text-base font-medium text-white hover:bg-amber-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300 active:scale-95">
                    Submit
                </button>
                
                <button type="button" onclick="closeContact()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>