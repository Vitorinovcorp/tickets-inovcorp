
<footer class="footer-custom">
    <div class="container-fluid">
        <div class="row">
            <!-- Coluna 1: Logo e Descrição -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="footer-brand">
                    <img src="{{ asset('images/inovcorp-logo.png') }}" 
                         alt="Inovcorp" 
                         class="footer-logo">
                    <span class="footer-brand-name">Tickets Inovcorp</span>
                </div>
                <p class="footer-description">
                    Sistema de gestão de tickets e comunicações centralizado, 
                    desenvolvido para otimizar o atendimento e suporte da sua organização.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Coluna 2: Links Rápidos -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Links Rápidos</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-chevron-right"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin.tickets.index') }}"><i class="fas fa-chevron-right"></i> Tickets</a></li>
                    <li><a href="{{ route('admin.entidades.index') }}"><i class="fas fa-chevron-right"></i> Entidades</a></li>
                    <li><a href="{{ route('admin.contactos.index') }}"><i class="fas fa-chevron-right"></i> Contactos</a></li>
                </ul>
            </div>

            <!-- Coluna 3: Suporte -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-title">Suporte</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Central de Ajuda</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Documentação</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Contato</a></li>
                </ul>
            </div>

            <!-- Coluna 4: Contato -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Contato</h5>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>tickets@inovcorp.com</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+351 210 000 000</span>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Lisboa, Portugal</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Seg - Sex: 09:00 - 18:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} <strong>Tickets Inovcorp</strong>. 
                        Todos os direitos reservados.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">
                        <a href="#">Política de Privacidade</a>
                        <span class="footer-divider">|</span>
                        <a href="#">Termos de Uso</a>
                        <span class="footer-divider">|</span>
                        <a href="#">Cookies</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>