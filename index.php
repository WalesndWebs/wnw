<?php include 'partials/header.php'; ?>

  <!-- Hero Section -->
  <section class="hero" id="home">
    <div class="hero-container">
      <div class="hero-content">
        <div class="hero-badge">Digital Systems. Real Impact.</div>
        <h1 class="hero-title">
          We Design The Systems<br>
          That <span class="highlight gradient-text">Solve Real<br>Business Problems.</span>
        </h1>
        <p class="hero-desc">
          We partner with ambitious businesses to design, build, and automate digital systems that improve operations, enhance customer experience, and drive long-term growth.
        </p>
        <div class="hero-buttons">
          <a href="#contact" class="btn btn-primary">Discuss Your Business &rarr;</a>
          <a href="#projects" class="btn btn-outline">See Our Work &rarr;</a>
        </div>
      </div>

      <div class="hero-visual">
        <div class="dashboard-mockup">
          <!-- Floating Icons -->
          <div class="float-icon purple">&#128200;</div>
          <div class="float-icon green">&#128101;</div>
          <div class="float-icon blue">&#9881;</div>

          <div class="dashboard-header">
            <div class="dashboard-title">
              <div class="w-icon">W</div>
              <span>Wales & Webs Dashboard</span>
            </div>
            <div class="dashboard-actions">
              <div class="d-action">&#128269;</div>
              <div class="d-action">&#128276;</div>
              <div class="d-action">&#128100;</div>
            </div>
          </div>

          <div class="dashboard-stats">
            <div class="d-stat">
              <div class="d-stat-value" data-count="128">0</div>
              <div class="d-stat-label">Total Projects</div>
              <div class="d-stat-trend">&#9650; 12%</div>
            </div>
            <div class="d-stat">
              <div class="d-stat-value" data-count="86">0</div>
              <div class="d-stat-label">Active Clients</div>
              <div class="d-stat-trend">&#9650; 8%</div>
            </div>
            <div class="d-stat">
              <div class="d-stat-value" data-count="98" data-suffix="%">0</div>
              <div class="d-stat-label">Success Rate</div>
              <div class="d-stat-trend">&#9650; 2%</div>
            </div>
            <div class="d-stat">
              <div class="d-stat-value" data-count="32">0</div>
              <div class="d-stat-label">Support Tickets</div>
              <div class="d-stat-trend" style="color: #ef4444;">&#9660; 5%</div>
            </div>
          </div>

          <div class="dashboard-charts">
            <div class="d-chart-box">
              <div class="d-chart-title">Project Performance</div>
              <canvas id="projectPerformanceChart" height="120"></canvas>
            </div>
            <div class="d-chart-box">
              <div class="d-chart-title">Top Services</div>
              <canvas id="topServicesChart" height="120"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Trust Bar -->
  <section class="trust-bar">
    <div class="trust-container">
      <p class="trust-label">Trusted by growing businesses</p>
      <div class="trust-content">
        <div class="trust-logos">
          <span class="trust-logo">SkyCapital</span>
          <span class="trust-logo">PrimePay</span>
          <span class="trust-logo">SwiftPay</span>
          <span class="trust-logo">PrimeCare</span>
          <span class="trust-logo">AdeConcept</span>
        </div>
        <div class="trust-divider"></div>
        <div class="trust-stats">
          <div class="t-stat">
            <div class="t-stat-value" data-count="50" data-suffix="+">0</div>
            <div class="t-stat-label">Projects Delivered</div>
          </div>
          <div class="t-stat">
            <div class="t-stat-value" data-count="30" data-suffix="+">0</div>
            <div class="t-stat-label">Businesses Transformed</div>
          </div>
          <div class="t-stat">
            <div class="t-stat-value" data-count="5" data-suffix="+">0</div>
            <div class="t-stat-label">Years Of Impact</div>
          </div>
          <div class="t-stat">
            <div class="t-stat-value" data-count="100" data-suffix="%">0</div>
            <div class="t-stat-label">Client Commitment</div>
          </div>
          <div class="t-stat">
            <div class="t-stat-value">24/7</div>
            <div class="t-stat-label">Support Available</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Process Section -->
  <section class="section" id="story">
    <div class="section-container">
      <div class="section-header">
        <h2 class="section-title">We Don't Just Build Websites.<br>We Solve <span class="gradient-text">Business Problems.</span></h2>
      </div>

      <div class="process-grid">
        <div class="process-card fade-in">
          <div class="process-icon">&#129300;</div>
          <h3 class="process-title">Business Problems</h3>
          <p class="process-desc">Every business faces challenges that slow growth, waste time, and reduce profitability.</p>
          <a href="#" class="process-link">Learn More &rarr;</a>
        </div>

        <div class="process-card fade-in">
          <div class="process-icon">&#127919;</div>
          <h3 class="process-title">Our Strategy</h3>
          <p class="process-desc">We study your processes, understand your goals, and design the right system.</p>
          <a href="#" class="process-link">Learn More &rarr;</a>
        </div>

        <div class="process-card fade-in">
          <div class="process-icon">&#128187;</div>
          <h3 class="process-title">Technology That Works</h3>
          <p class="process-desc">We build secure, scalable systems that automate, organize, and empower your business.</p>
          <a href="#" class="process-link">Learn More &rarr;</a>
        </div>

        <div class="process-card fade-in">
          <div class="process-icon">&#128200;</div>
          <h3 class="process-title">Business Transformation</h3>
          <p class="process-desc">Real transformation, improved performance, happier customers, and sustainable growth.</p>
          <a href="#" class="process-link">Learn More &rarr;</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Case Studies -->
  <section class="section" id="projects" style="background: linear-gradient(180deg, transparent 0%, rgba(16, 185, 129, 0.02) 50%, transparent 100%);">
    <div class="section-container">
      <div class="case-studies-header">
        <div>
          <h2 class="section-title">Featured Case Studies</h2>
          <p class="section-subtitle">Real projects. Real results.</p>
        </div>
        <a href="#" class="section-link">View All Case Studies &rarr;</a>
      </div>

      <div class="case-grid">
        <!-- Case 1 -->
        <div class="case-card fade-in">
          <div class="case-image">
            <span class="case-tag tag-fintech">FinTech</span>
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;">&#128241;</div>
          </div>
          <div class="case-content">
            <h3 class="case-title">SkyCapital Digital Onboarding</h3>
            <p class="case-desc">End-to-end onboarding system that verifies, assesses, and manages customers seamlessly.</p>
            <div class="case-metrics">
              <div class="c-metric">
                <div class="c-metric-value">10K+</div>
                <div class="c-metric-label">Users Onboarded</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">80%</div>
                <div class="c-metric-label">Processing Time</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">99.9%</div>
                <div class="c-metric-label">Accuracy Rate</div>
              </div>
            </div>
            <a href="#" class="case-link">View Case Study &rarr;</a>
          </div>
        </div>

        <!-- Case 2 -->
        <div class="case-card fade-in">
          <div class="case-image">
            <span class="case-tag tag-restaurant">Restaurant</span>
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a2e 0%, #2d1b4e 50%, #1a1a2e 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;">&#127860;</div>
          </div>
          <div class="case-content">
            <h3 class="case-title">Taste by Edima</h3>
            <p class="case-desc">Restaurant website with online ordering, gallery, and brand storytelling that boosted customer engagement.</p>
            <div class="case-metrics">
              <div class="c-metric">
                <div class="c-metric-value">+65%</div>
                <div class="c-metric-label">Online Orders</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">+120%</div>
                <div class="c-metric-label">Engagement</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">+85%</div>
                <div class="c-metric-label">Repeat Customers</div>
              </div>
            </div>
            <a href="#" class="case-link">View Case Study &rarr;</a>
          </div>
        </div>

        <!-- Case 3 -->
        <div class="case-card fade-in">
          <div class="case-image">
            <span class="case-tag tag-operations">Operations</span>
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;">&#128085;</div>
          </div>
          <div class="case-content">
            <h3 class="case-title">Laundry Management System</h3>
            <p class="case-desc">A complete laundry management solution that automated operations and improved tracking.</p>
            <div class="case-metrics">
              <div class="c-metric">
                <div class="c-metric-value">5K+</div>
                <div class="c-metric-label">Orders Managed</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">+70%</div>
                <div class="c-metric-label">Efficiency</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">98%</div>
                <div class="c-metric-label">Customer Satisfaction</div>
              </div>
            </div>
            <a href="#" class="case-link">View Case Study &rarr;</a>
          </div>
        </div>

        <!-- Case 4 -->
        <div class="case-card fade-in">
          <div class="case-image">
            <span class="case-tag tag-corporate">Corporate</span>
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a2e 0%, #3d1f4e 50%, #1a1a2e 100%);display:flex;align-items:center;justify-content:center;font-size:3rem;">&#127760;</div>
          </div>
          <div class="case-content">
            <h3 class="case-title">AdeConcept Corporate Website</h3>
            <p class="case-desc">A modern corporate website that positions AdeConcept as a trusted printing & branding partner.</p>
            <div class="case-metrics">
              <div class="c-metric">
                <div class="c-metric-value">+90%</div>
                <div class="c-metric-label">Leads Generated</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">+85%</div>
                <div class="c-metric-label">Brand Visibility</div>
              </div>
              <div class="c-metric">
                <div class="c-metric-value">+110%</div>
                <div class="c-metric-label">Engagement</div>
              </div>
            </div>
            <a href="#" class="case-link">View Case Study &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Usabime Philosophy -->
  <section class="section usabime-section" id="about">
    <div class="section-container">
      <div class="usabime-grid">
        <div class="usabime-left">
          <h2 class="usabime-title">The Usabime<br>Philosophy</h2>
          <p class="usabime-desc">We believe technology should create value for businesses, the people who use it, and the teams who build it.</p>
          <a href="#" class="btn btn-primary">Learn More About Usabime &rarr;</a>
        </div>

        <div class="usabime-right">
          <div class="infinity-diagram">
            <svg class="infinity-svg" viewBox="0 0 400 300" fill="none">
              <!-- Infinity Loop Path -->
              <path d="M200 150 C 200 80, 100 80, 100 150 C 100 220, 200 220, 200 150 C 200 80, 300 80, 300 150 C 300 220, 200 220, 200 150" 
                    stroke="url(#gradient)" stroke-width="2" fill="none" stroke-dasharray="8 4" opacity="0.5"/>
              <defs>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" style="stop-color:#10b981"/>
                  <stop offset="100%" style="stop-color:#8b5cf6"/>
                </linearGradient>
              </defs>
            </svg>

            <!-- People Node -->
            <div class="infinity-node" style="top: 10%; left: 5%;">
              <div class="node-icon">&#128101;</div>
              <div class="node-label">People</div>
              <div class="node-desc">We design systems that people enjoy using</div>
            </div>

            <!-- Business Node -->
            <div class="infinity-node" style="top: 0; left: 50%; transform: translateX(-50%);">
              <div class="node-icon">&#128188;</div>
              <div class="node-label">Business</div>
              <div class="node-desc">We help businesses operate better, grow faster</div>
            </div>

            <!-- Technology Node -->
            <div class="infinity-node" style="top: 10%; right: 5%;">
              <div class="node-icon">&#9881;</div>
              <div class="node-label">Technology</div>
              <div class="node-desc">We use the right technology to build secure systems</div>
            </div>

            <!-- Center Logo -->
            <div class="center-logo">W</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="section" id="services">
    <div class="section-container">
      <div class="section-header">
        <h2 class="section-title">What We Help Businesses Build</h2>
        <p class="section-subtitle">Digital systems that power growth and efficiency.</p>
      </div>

      <div class="services-grid">
        <div class="service-card fade-in">
          <div class="service-icon">&#128200;</div>
          <h3 class="service-title">Web Systems</h3>
          <p class="service-desc">High-performing websites and web applications that convert visitors into customers.</p>
          <div class="service-arrow">&rarr;</div>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">&#9851;</div>
          <h3 class="service-title">Automation</h3>
          <p class="service-desc">Automate workflows, processes, and manual tasks to save time and reduce errors.</p>
          <div class="service-arrow">&rarr;</div>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">&#128241;</div>
          <h3 class="service-title">Mobile Apps</h3>
          <p class="service-desc">Custom mobile applications for iOS and Android that drive engagement.</p>
          <div class="service-arrow">&rarr;</div>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">&#128421;</div>
          <h3 class="service-title">Dashboard Systems</h3>
          <p class="service-desc">Real-time dashboards and portals that give you full visibility of your business.</p>
          <div class="service-arrow">&rarr;</div>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">&#128279;</div>
          <h3 class="service-title">Integration</h3>
          <p class="service-desc">Connect your tools, systems, and data for seamless and efficient operations.</p>
          <div class="service-arrow">&rarr;</div>
        </div>

        <div class="service-card fade-in">
          <div class="service-icon">&#128161;</div>
          <h3 class="service-title">Consulting</h3>
          <p class="service-desc">Business and technology consulting to help you make better decisions.</p>
          <div class="service-arrow">&rarr;</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Insights & Resources -->
  <section class="section" id="resources">
    <div class="section-container">
      <div class="case-studies-header">
        <div>
          <h2 class="section-title">Insights & Resources</h2>
          <p class="section-subtitle">Thoughts, stories, and insights to grow your business.</p>
        </div>
        <a href="#" class="section-link">View All Articles &rarr;</a>
      </div>

      <div class="insights-grid">
        <div class="insight-card fade-in">
          <div class="insight-image">
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a2e 0%, #2d1b4e 100%);"></div>
            <span class="insight-date">May 20, 2025</span>
          </div>
          <div class="insight-content">
            <h3 class="insight-title">Why 80% of Business Websites Don't Generate Leads (And How to Fix It)</h3>
            <a href="#" class="insight-link">Read More &rarr;</a>
          </div>
        </div>

        <div class="insight-card fade-in">
          <div class="insight-image">
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);"></div>
            <span class="insight-date">May 15, 2025</span>
          </div>
          <div class="insight-content">
            <h3 class="insight-title">The Power of Business Automation: Save Time, Increase Profit</h3>
            <a href="#" class="insight-link">Read More &rarr;</a>
          </div>
        </div>

        <div class="insight-card fade-in">
          <div class="insight-image">
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a2e 0%, #3d1f4e 100%);"></div>
            <span class="insight-date">May 10, 2025</span>
          </div>
          <div class="insight-content">
            <h3 class="insight-title">User Experience Design Principles That Increase Conversions</h3>
            <a href="#" class="insight-link">Read More &rarr;</a>
          </div>
        </div>

        <div class="insight-card fade-in">
          <div class="insight-image">
            <div style="width:100%;height:100%;background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%);"></div>
            <span class="insight-date">May 5, 2025</span>
          </div>
          <div class="insight-content">
            <h3 class="insight-title">How Digital Systems Help Businesses Scale Without Chaos</h3>
            <a href="#" class="insight-link">Read More &rarr;</a>
          </div>
        </div>
      </div>

      <!-- Newsletter -->
      <div class="newsletter-box fade-in">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: center;">
          <div>
            <h3 class="newsletter-title">Get Insights That Drive Growth</h3>
            <p class="newsletter-desc">Subscribe to get the latest tips, strategies, and insights.</p>
          </div>
          <form class="newsletter-form">
            <input type="email" class="newsletter-input" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary">Subscribe &rarr;</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="section cta-section" id="contact">
    <div class="section-container">
      <div class="cta-grid">
        <div class="cta-person">
          <div class="cta-person-img">
            <div class="cta-person-placeholder">&#128104;</div>
          </div>
        </div>

        <div class="cta-content">
          <h2 class="cta-title">Ready to Solve Your<br>Next Business Challenge?</h2>
          <p class="cta-desc">Let's design and build the right systems for your business.</p>

          <div class="cta-buttons">
            <a href="#" class="btn btn-primary">Discuss Your Project &rarr;</a>
            <a href="#" class="btn btn-outline">Book a Free Consultation</a>
          </div>

          <div class="cta-features">
            <div class="cta-feature">
              <div class="cf-icon">&#128172;</div>
              <div>
                <div class="cf-title">No Pressure</div>
                <div class="cf-desc">Just a friendly conversation to understand your needs.</div>
              </div>
            </div>

            <div class="cta-feature">
              <div class="cf-icon">&#127912;</div>
              <div>
                <div class="cf-title">Tailored Solutions</div>
                <div class="cf-desc">Solutions designed specifically for your business.</div>
              </div>
            </div>

            <div class="cta-feature">
              <div class="cf-icon">&#129309;</div>
              <div>
                <div class="cf-title">Long-term Partner</div>
                <div class="cf-desc">We grow with your business, not just your project.</div>
              </div>
            </div>

            <div class="cta-feature">
              <div class="cf-icon">&#127942;</div>
              <div>
                <div class="cf-title">Proven Results</div>
                <div class="cf-desc">Our solutions deliver real impact and measurable growth.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include 'partials/footer.php'; ?>
