    </main>

    <!--Footer position relative si o si-->
    <footer class="cs-fl cs-fl-just-c cs-fl-align-c">
        <div class="cs-fl">
            <p>
                <a href="#">Política de privacidad</a>
            </p>
            <p>
                <a href="#">Cookies</a>
            </p>
            <p>
                <a href="#">Contacto</a>
            </p>
        </div>
        <div class="cs-fl">
            <p>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
            </p>
            <p>
                <a href="#">
                    <i class="fab fa-github"></i>
                </a>
            </p>
            <p>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
            </p>
        </div>
    </footer>
    </body>
    <script>
        const asideHider = document.getElementById('aside-hider');
        const aside = document.getElementById('aside');

        asideHider.addEventListener('click', () => {
            const currentWidth = getComputedStyle(document.documentElement).getPropertyValue('--aside-width');

            if (currentWidth === '250px') {
                document.documentElement.style.setProperty('--aside-width', '100px');
            } else {
                document.documentElement.style.setProperty('--aside-width', '250px');
            }
        });
    </script>

    </html>