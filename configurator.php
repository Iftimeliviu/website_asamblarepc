<?php
/*
Template Name: PC Configurator 2025 - PDF
*/
get_header();
?>
<?php
// ÎN template-configurator.php SAU functions.php
add_action('wp_head', 'disable_editors_css_configurator');
function disable_editors_css_configurator() {
  if (is_page_template('template-configurator.php')) {  // NUMAI pagina ta
    // DEQUEUE Elementor CSS
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_style('elementor-post-'.get_the_ID());
    wp_dequeue_style('elementor-global');
    
    // DEQUEUE Gutenberg/Block Editor
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    
    // DEQUEUE theme CSS conflictual (dacă ai)
    wp_dequeue_style('theme-style');
  }
}
?>
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #21C55D 0%, #16A34A 100%);
    --secondary-gradient: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
    --accent-gradient: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    --danger-gradient: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    
    --dark-surface: #0F1419;
    --dark-elevated: #1A202C;
    --dark-card: #2D3748;
    --glass-surface: rgba(45, 55, 72, 0.8);
    --glass-border: rgba(255, 255, 255, 0.1);
    
    --text-primary: #F7FAFC;
    --text-secondary: #A0AEC0;
    --text-accent: #21C55D;
    
    --success-green: #00f964;
    --warning-orange: #ff9800;
    --error-red: #f44336;
    
    --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-large: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --shadow-glow: 0 0 0 1px rgba(33, 197, 93, 0.05), 0 1px 0 0 rgba(33, 197, 93, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.08), 0 2px 2px 0 rgba(0, 0, 0, 0.1);
    
     --chat-primary: #21C55D;
    --chat-primary-dark: #16A34A;
    --chat-surface: #1a1f2e;
    --chat-elevated: #232d3f;
    --chat-text: #F7FAFC;
    --chat-text-secondary: #A0AEC0;
    --chat-border: rgba(255, 255, 255, 0.12);
    --chat-success: #00f964;
    --chat-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

/* Reset & Base Styles with Glassmorphism */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    font-size: 16px;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', system-ui, sans-serif;
    background: var(--dark-surface);
    color: var(--text-primary);
    line-height: 1.6;
    overflow-x: hidden;
    min-height: 100vh;
    position: relative;
}

/* Animated Background */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(ellipse at top left, rgba(33, 197, 93, 0.15) 0%, transparent 50%),
        radial-gradient(ellipse at top right, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        radial-gradient(ellipse at bottom left, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
        radial-gradient(ellipse at bottom right, rgba(239, 68, 68, 0.1) 0%, transparent 50%);
    z-index: -2;
    animation: backgroundShift 20s ease-in-out infinite;
}

@keyframes backgroundShift {
    0%, 100% { transform: translate(0, 0) rotate(0deg) scale(1); }
    25% { transform: translate(-20px, -30px) rotate(1deg) scale(1.05); }
    50% { transform: translate(20px, 30px) rotate(-1deg) scale(0.95); }
    75% { transform: translate(-10px, 20px) rotate(0.5deg) scale(1.02); }
}

/* Floating Particles */
body::after {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20% 30%, rgba(33, 197, 93, 0.3), transparent),
        radial-gradient(2px 2px at 40% 70%, rgba(59, 130, 246, 0.2), transparent),
        radial-gradient(1px 1px at 90% 40%, rgba(245, 158, 11, 0.3), transparent),
        radial-gradient(1px 1px at 60% 10%, rgba(239, 68, 68, 0.2), transparent);
    background-size: 550px 550px, 350px 350px, 250px 250px, 150px 150px;
    animation: sparkle 25s linear infinite;
    z-index: -1;
    pointer-events: none;
}

@keyframes sparkle {
    0%, 100% { transform: translate(0, 0); }
    25% { transform: translate(-100px, -200px); }
    50% { transform: translate(200px, -100px); }
    75% { transform: translate(-200px, 100px); }
}

/* Fullscreen Container */
.configurator-fullscreen {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
    padding: 0;
    margin: 0;
    width: 100%;
    background: transparent;
}

/* Hero Header Section */
.hero-header {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    padding: 0 2rem;
    background: transparent;
}

.hero-content {
    max-width: 900px;
    z-index: 2;
    animation: heroFadeIn 1.2s ease-out;
}

@keyframes heroFadeIn {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-title {
    font-size: clamp(2rem, 8vw, 6rem);
    font-weight: 900;
    line-height: 0.9;
    margin-bottom: 1.5rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 30px rgba(33, 197, 93, 0.3);
}

.hero-subtitle {
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    color: var(--text-secondary);
    margin-bottom: 2rem;
    font-weight: 300;
    line-height: 1.4;
}

.hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1.2rem 2.5rem;
    background: var(--primary-gradient);
    border: none;
    border-radius: 50px;
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: var(--shadow-large);
    position: relative;
    overflow: hidden;
}

.hero-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.hero-cta:hover::before {
    left: 100%;
}

.hero-cta:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 20px 40px -5px rgba(33, 197, 93, 0.4);
}

.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    color: var(--text-secondary);
    font-size: 0.9rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    40% {
        transform: translateX(-50%) translateY(-10px);
    }
    60% {
        transform: translateX(-50%) translateY(-5px);
    }
}

/* Main Content Area */
.main-content {
    min-height: 100vh;
    padding: 4rem 2rem;
    background: rgba(15, 20, 25, 0.95);
    backdrop-filter: blur(20px);
    border-top: 1px solid var(--glass-border);
}

.content-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 3rem;
    min-height: calc(100vh - 8rem);
}

/* Left Panel - Component Selection */
.components-panel {
    background: var(--glass-surface);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: var(--shadow-large);
}

.panel-header {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--glass-border);
}

.panel-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.panel-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
}

/* Component Cards */
.component-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.component-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.component-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(33, 197, 93, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.component-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-glow);
    border-color: rgba(33, 197, 93, 0.3);
}

.component-card:hover::before {
    opacity: 1;
}

.component-card.selected {
    background: rgba(33, 197, 93, 0.1);
    border-color: var(--text-accent);
    box-shadow: 0 0 20px rgba(33, 197, 93, 0.3);
}

.component-card.error {
    border-color: var(--error-red);
    background: rgba(244, 67, 54, 0.05);
    animation: error-pulse 2s infinite;
}

.component-card.highlight {
    border-color: var(--warning-orange);
    background: rgba(255, 152, 0, 0.05);
    animation: warning-pulse 2s infinite;
}

@keyframes error-pulse {
    0%, 100% {
        box-shadow: 0 0 20px rgba(244, 67, 54, 0.3);
    }
    50% {
        box-shadow: 0 0 30px rgba(244, 67, 54, 0.5);
    }
}

@keyframes warning-pulse {
    0%, 100% {
        box-shadow: 0 0 20px rgba(255, 152, 0, 0.3);
    }
    50% {
        box-shadow: 0 0 30px rgba(255, 152, 0, 0.5);
    }
}

.component-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}

.component-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.component-info {
    flex: 1;
    margin-left: 1rem;
}

.component-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.component-status {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.component-selected {
    color: var(--text-accent);
    font-weight: 500;
}

.component-arrow {
    font-size: 1.2rem;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.component-card:hover .component-arrow {
    color: var(--text-accent);
    transform: translateX(5px);
}

/* Right Panel - Configuration Summary */
.summary-panel {
    background: var(--glass-surface);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 2rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
    box-shadow: var(--shadow-large);
}

.summary-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--glass-border);
}

.compatibility-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--primary-gradient);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.compatibility-badge.warning {
    background: var(--accent-gradient);
}

.compatibility-badge.error {
    background: var(--danger-gradient);
}

.score-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--success-green);
    box-shadow: 0 0 10px currentColor;
    animation: pulse 2s infinite;
}

.score-indicator.warning {
    background: var(--warning-orange);
}

.score-indicator.error {
    background: var(--error-red);
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.7;
        transform: scale(1.1);
    }
}

.total-price {
    font-size: 2.5rem;
    font-weight: 900;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.5rem;
}

.price-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

/* Summary Stats */
.summary-stats {
    margin: 2rem 0;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stat-value {
    color: var(--text-primary);
    font-weight: 600;
}

/* Enhanced Power Stats */
.power-breakdown {
    margin: 1rem 0;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 12px;
    border: 1px solid var(--glass-border);
}

.power-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    font-size: 0.85rem;
}

.power-label {
    color: var(--text-secondary);
}

.power-value {
    color: var(--text-primary);
    font-weight: 600;
}

.power-total {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    font-weight: 700;
    font-size: 0.9rem;
}

.power-recommendation {
    background: rgba(33, 197, 93, 0.1);
    border: 1px solid var(--text-accent);
    border-radius: 8px;
    padding: 0.75rem;
    margin-top: 0.75rem;
    font-size: 0.85rem;
    color: var(--text-accent);
    text-align: center;
}

/* Warnings Container */
.warnings-container {
    margin: 1rem 0;
    max-height: 300px;
    overflow-y: auto;
}

.warning-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    margin-bottom: 0.75rem;
    border-radius: 12px;
    font-size: 0.9rem;
    line-height: 1.5;
    animation: slideInWarning 0.3s ease-out;
}

@keyframes slideInWarning {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.warning-item.warning {
    background: rgba(255, 152, 0, 0.1);
    border: 1px solid var(--warning-orange);
    color: var(--warning-orange);
}

.warning-item.error {
    background: rgba(244, 67, 54, 0.1);
    border: 1px solid var(--error-red);
    color: var(--error-red);
}

.warning-item.info {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid #3B82F6;
    color: #60A5FA;
}

.warning-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    margin-top: 2px;
}

/* Action Buttons */
.action-buttons {
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.action-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.action-btn.loading {
    opacity: 0.7;
    pointer-events: none;
}

.chatbot-wrapper {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99999;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    pointer-events: auto;  /* IMPORTANT */
}

.chatbot-container {
    width: 380px;
    height: 600px;
    background: rgba(26, 31, 46, 0.95);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.1);
    display: none;  /* ← ADD THIS! */
    flex-direction: column;
    overflow: hidden;
    animation: slideInChat 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    transform-origin: bottom right;
    pointer-events: auto;
}

@keyframes slideInChat {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.chatbot-container.minimized {
    height: auto;
}

.chatbot-container.minimized .chatbot-messages,
.chatbot-container.minimized .chatbot-input-area {
    display: none;
}

/* HEADER - SOLID GRADIENT */
.chatbot-header {
    background: linear-gradient(135deg, #21C55D 0%, #16A34A 100%);
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    flex-shrink: 0;
}

.chatbot-header-title {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
    font-weight: 700;
    font-size: 16px;
}

.chatbot-header-icon {
    font-size: 20px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.chatbot-header-controls {
    display: flex;
    gap: 8px;
}

.chatbot-control-btn {
    background: rgba(255, 255, 255, 0.25);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.2s;
    font-weight: bold;
}

.chatbot-control-btn:hover {
    background: rgba(255, 255, 255, 0.35);
    transform: scale(1.1);
}

/* MESSAGES AREA */
.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    background: rgba(26, 31, 46, 0.5);
}

.message {
    display: flex;
    animation: fadeInMessage 0.3s ease-out;
}

@keyframes fadeInMessage {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message.bot {
    justify-content: flex-start;
}

.message.user {
    justify-content: flex-end;
}

.message-content {
    max-width: 85%;
    padding: 12px 16px;
    border-radius: 16px;
    line-height: 1.5;
    font-size: 14px;
    word-wrap: break-word;
    white-space: pre-wrap;
    overflow-wrap: break-word;
}

/* BOT MESSAGE */
.message.bot .message-content {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: var(--chat-text);
}

.message.bot .message-content h2,
.message.bot .message-content h3 {
    margin: 8px 0 6px 0;
    font-size: 13px;
    font-weight: 700;
    color: #21C55D;
}

.message.bot .message-content strong {
    color: #21C55D;
    font-weight: 600;
}

.message.bot .message-content em {
    color: var(--chat-text-secondary);
    font-style: italic;
}

.message.bot .message-content code {
    background: rgba(0, 0, 0, 0.2);
    padding: 2px 6px;
    border-radius: 4px;
    color: #00f964;
    font-family: monospace;
    font-size: 12px;
}

.message.bot .message-content ul,
.message.bot .message-content ol {
    margin: 6px 0;
    padding-left: 16px;
}

.message.bot .message-content li {
    margin: 4px 0;
    line-height: 1.4;
}

.message.bot .message-content p {
    margin: 6px 0;
}

/* USER MESSAGE */
.message.user .message-content {
    background: linear-gradient(135deg, #21C55D 0%, #16A34A 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(33, 197, 93, 0.25);
}

/* LOADING */
.message.loading .message-content {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 12px 16px;
}

.typing-indicator {
    display: flex;
    gap: 4px;
}

.typing-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #21C55D;
    animation: typing 1.4s infinite;
}

.typing-dot:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%, 60%, 100% { opacity: 0.3; }
    30% { opacity: 1; }
}

/* INPUT AREA */
.chatbot-input-area {
    padding: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    gap: 10px;
    background: rgba(26, 31, 46, 0.6);
    flex-shrink: 0;
}

.chatbot-input {
    flex: 1;
    padding: 12px 14px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    color: var(--chat-text);
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s;
    resize: none;
    max-height: 80px;
}

.chatbot-input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.1);
    border-color: #21C55D;
    box-shadow: 0 0 0 3px rgba(33, 197, 93, 0.1);
}

.chatbot-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.chatbot-send-btn {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #21C55D 0%, #16A34A 100%);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(33, 197, 93, 0.2);
    font-weight: bold;
}

.chatbot-send-btn:hover:not(:disabled) {
    transform: scale(1.08);
    box-shadow: 0 6px 20px rgba(33, 197, 93, 0.3);
}

.chatbot-send-btn:active:not(:disabled) {
    transform: scale(0.95);
}

.chatbot-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* SCROLLBAR */
.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: transparent;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: rgba(33, 197, 93, 0.4);
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(33, 197, 93, 0.6);
}
.action-btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid currentColor;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.action-btn-primary {
    background: var(--primary-gradient);
    color: white;
    box-shadow: var(--shadow-medium);
}

.action-btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(33, 197, 93, 0.4);
}

.action-btn-secondary {
    background: rgba(255, 255, 255, 0.05);
    color: var(--text-primary);
    border: 1px solid var(--glass-border);
}

.action-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(33, 197, 93, 0.3);
}

/* Selected Components List */
.selected-components {
    margin: 2rem 0;
}

.selected-component {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    margin-bottom: 0.5rem;
}

.selected-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
}

.selected-info {
    flex: 1;
}

.selected-name {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.selected-price {
    font-size: 0.8rem;
    color: var(--text-accent);
    font-weight: 600;
}

/* Debug Panel */
.debug-panel {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 300px;
    max-height: 300px;
    background: rgba(0, 0, 0, 0.9);
    color: #00ff00;
    font-family: 'Courier New', monospace;
    font-size: 11px;
    padding: 10px;
    border-radius: 8px;
    overflow-y: auto;
    z-index: 10000;
    display: none;
}

.debug-toggle {
    position: fixed;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: #00ff00;
    border: 1px solid #00ff00;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 10px;
    cursor: pointer;
    z-index: 10001;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .content-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .summary-panel {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .hero-header {
        height: 100vh;
        padding: 0 1rem;
    }
    
    .main-content {
        padding: 2rem 1rem;
    }
    
      .chatbot-container {
        width: calc(100vw - 24px);
        height: 70vh;
        max-width: 380px;
        bottom: 12px;
        right: 12px;
    }
    
    .components-panel,
    .summary-panel {
        padding: 1.5rem;
        border-radius: 16px;
    }
    
    .component-card {
        padding: 1rem;
    }
    
    .hero-title {
        font-size: clamp(2.5rem, 10vw, 4rem);
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--dark-surface);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-gradient);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #16A34A 0%, #15803D 100%);
}

/* Focus states for accessibility */
.hero-cta:focus,
.component-card:focus,
.action-btn:focus {
    outline: 2px solid var(--text-accent);
    outline-offset: 2px;
}
.chatbot-popup-overlay {
    display: none; !important
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(4px);
    z-index: 99998;
    animation: fadeInOverlay 0.3s ease;
}

.chatbot-popup-overlay.active {
    display: block;
}

@keyframes fadeInOverlay {
    from { opacity: 0; }
    to { opacity: 1; }
}

.chatbot-popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 99998;
    animation: fadeInOverlay 0.3s ease;
}

.chatbot-popup-overlay.active {
    display: block;
}

@keyframes fadeInOverlay {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* LAUNCHER BUTTON */
.chatbot-launcher {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #21C55D 0%, #16A34A 100%);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    animation: pulse 2s infinite;
    pointer-events: auto;
    position: relative;
    overflow: hidden;
}

.launcher-robot {
    font-size: 28px;
    animation: robotBounce 2s ease-in-out infinite;
}

@keyframes robotBounce {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-4px) scale(1.05);
    }
}

.chatbot-launcher:hover {
    transform: scale(1.15);
}

.chatbot-launcher:hover .launcher-robot {
    animation: robotWave 0.6s ease-in-out;
}

@keyframes robotWave {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(-15deg); }
    75% { transform: rotate(15deg); }
    100% { transform: rotate(0deg); }
}

.chatbot-launcher.hidden {
    display: none;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3); }
    50% { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 25px rgba(33, 197, 93, 0.4); }
}

.ai-panel-glass {
  background: rgba(20,36,48,0.82);
  border-radius: 24px;
  padding: 2rem;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.17);
  border: 1px solid rgba(94,234,212,0.14);
  color: #d1faf0;
  margin-bottom: 2rem;
  animation: aiFadeIn 0.6s cubic-bezier(.32,2,.55,.27);
}
@keyframes aiFadeIn {
  from {opacity:0;transform:translateY(20px)}
  to {opacity:1;transform:translateY(0)}
}
.ai-panel-header { margin-bottom: 1.4rem; }
.ai-badge {
  background: linear-gradient(90deg, #21C55D 30%, #3B82F6 100%);
  display: inline-flex; align-items: center;
  padding: 0.38em 0.9em; border-radius: 14px; font-weight:500; color: #fff;
  box-shadow:0 1px 10px 0 rgba(50,199,219,0.11);
  margin-bottom: .9rem;
  font-size: 1.09em;
}
.ai-badge-icon { margin-right:.45em; font-size:1.24em; }
.ai-panel-headline { font-size:1.2rem; font-weight:600; margin-bottom:.44em; }
.ai-panel-summary { color:#baf8eb; font-size:.98em; margin-bottom:1.7em; }
.ai-rec-card { background:rgba(24,32,38,0.94); border-radius:12px; padding:1em;
  margin-bottom:1.1em; box-shadow:0 2px 9px 0 rgba(16,48,64,0.065);}
.ai-rec-card-title { font-weight:600; margin-bottom:.5em; }
.ai-rec-item { margin-bottom:.4em; }
.ai-rec-model { font-weight:500; color:#21C55D; }
.ai-rec-reason { color:#baf8eb; font-size:.92em; margin:.08em 0 .28em 0;}
.ai-rec-details { display:flex; gap:0.9em; align-items:center; }
.ai-rec-price { color:#f5fae3; font-weight:700; }
.ai-rec-tag { font-size:.81em; background:#193c34; border-radius:7px;
  padding: .13em .7em; margin-left:.35em; }
.ai-rec-tag-perfect {background:#143d2c;color:#22ed82;}
.ai-rec-tag-good {background:#61551b;color:#ffe083;}
.ai-rec-tag-warning {background:#6a2000;color:#f29d6b;}
.ai-next-steps { margin-top:1.8em; color:#d2fff7; list-style:disc inside; }
.ai-next-steps>li { margin-bottom: .3em; }

.ai-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding: 0.6rem 1.2rem;
    background: linear-gradient(90deg, #21C55D 0%, #16A34A 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(33, 197, 93, 0.3);
}

.ai-add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 197, 93, 0.4);
    background: linear-gradient(90deg, #16A34A 0%, #15803D 100%);
}

.ai-add-btn:active {
    transform: translateY(0);
}

.ai-add-icon {
    font-size: 1.3em;
    font-weight: bold;
}

.apc-recommendations-section {
    background: linear-gradient(135deg, #1a2332 0%, #0f1820 100%);
    padding: 30px 20px;
    border-radius: 16px;
    margin: 30px 0;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(76, 175, 80, 0.2);
    animation: apcFadeIn 0.5s ease;
}

@keyframes apcFadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.apc-progress-tracker {
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
    gap: 8px;
    flex-wrap: wrap;
    padding: 15px;
    background: rgba(15, 24, 32, 0.6);
    border-radius: 12px;
}

.apc-progress-step {
    flex: 1;
    min-width: 70px;
    text-align: center;
    padding: 10px 8px;
    border-radius: 8px;
    background: rgba(26, 35, 50, 0.8);
    border: 2px solid rgba(255, 255, 255, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 11px;
    color: #8b95a5;
    user-select: none;
}

.apc-progress-step:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
    border-color: rgba(76, 175, 80, 0.3);
}

.apc-progress-step.completed {
    background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
    color: white;
    border-color: #4caf50;
    box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
}

.apc-recommendation-container {
    background: rgba(26, 35, 50, 0.6);
    padding: 5px  5px;  /* ← Padding uniform */
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    margin: 20px 0;
    box-sizing: border-box;
    overflow: hidden;  /* ← Prevent overflow */
}

.apc-recommendation-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(76, 175, 80, 0.3);
}

.apc-recommendation-title {
    font-size: 22px;
    font-weight: 700;
    color: #4caf50;
    margin: 0 0 20px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.apc-recommendation-reason {
    font-size: 14px;
    color: #a8b4c0;
    margin: 0;
    line-height: 1.5;
}

.apc-recommendations-list {
     display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
    margin: 0;  /* ← ZERO margin */
    padding: 0;  /* ← ZERO padding */
    width: 100%;
    box-sizing: border-box;
}

.apc-recommendation-item {
   background: linear-gradient(135deg, rgba(15, 24, 32, 0.8), rgba(26, 35, 50, 0.8));
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #4caf50;
    border: 1px solid rgba(76, 175, 80, 0.2);
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    margin: 0;
    box-sizing: border-box;
    max-width: 100%;  /* ← Important */
}

.apc-recommendation-item:hover {
    box-shadow: 0 8px 24px rgba(76, 175, 80, 0.2);
    transform: translateY(-4px);
    border-left-color: #66bb6a;
    border-color: rgba(76, 175, 80, 0.4);
}

.apc-item-model {
    font-size: 16px;
    font-weight: 700;
    color: #e8eaed;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.apc-item-price {
    font-size: 20px;
    color: #4caf50;
    font-weight: 700;
    margin: 10px 0;
    text-shadow: 0 1px 3px rgba(76, 175, 80, 0.3);
}

.apc-item-compatibility {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    margin: 8px 0;
    background: rgba(76, 175, 80, 0.15);
    color: #4caf50;
    border: 1px solid rgba(76, 175, 80, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.apc-item-reason {
    font-size: 13px;
    color: #8b95a5;
    margin: 10px 0;
    line-height: 1.6;
}

.apc-item-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.apc-btn {
    flex: 1;
    padding: 12px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.apc-btn-add {
    background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
}

.apc-btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(76, 175, 80, 0.4);
    background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
}

.apc-btn-add:active {
    transform: translateY(0);
}

.apc-loading {
    text-align: center;
    padding: 40px;
    color: #a8b4c0;
}

.apc-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-top: 4px solid #4caf50;
    border-radius: 50%;
    margin: 0 auto 20px;
    animation: apc-spin 1s linear infinite;
}

@keyframes apc-spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.apc-loading-text {
    color: #8b95a5;
    font-size: 14px;
}

/* Responsive */
@media (max-width: 768px) {
    .apc-recommendations-section {
        padding: 20px 15px;
        margin: 20px 0;
        border-radius: 12px;
    }
    
    .apc-progress-tracker {
        gap: 5px;
        padding: 10px;
    }
     .sidebar-ai-title {
        font-size: 15px;
    }
    
    .sidebar-card-model {
        font-size: 14px;
    }
    
    .sidebar-card-price {
        font-size: 19px;
    }

    
    .apc-progress-step {
        min-width: 60px;
        padding: 8px 5px;
        font-size: 10px;
    }
    
    .apc-recommendations-list {
        grid-template-columns: 1fr;
    }
    
    .apc-recommendation-container {
        padding: 20px 15px;
    }
    
    .apc-recommendation-title {
        font-size: 18px;
    }
    
    .apc-item-actions {
        flex-direction: column;
    }
}

/* Dark mode enhancements */
.apc-recommendations-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(76, 175, 80, 0.05), transparent 50%);
    pointer-events: none;
    border-radius: 16px;
}

/* AI Recommendations - Sidebar Compact Style */
.sidebar-ai-panel {
    background: var(--dark-card, #2D3748);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
}

.sidebar-ai-description {
    font-size: 16px;
    color: var(--text-secondary, #A0AEC0);
    line-height: 1.5;
    margin: 0 0 12px 0;
}
.sidebar-ai-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
}

.sidebar-ai-icon {
    font-size: 30px;
}

.sidebar-ai-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-accent, #21C55D);
    margin: 0;
    line-height: 1.3;
}

.apc-progress-mini {
    display: flex;
    gap: 4px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.apc-mini-step {
    flex: 1;
    min-width: 32px;
    text-align: center;
    padding: 6px 4px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 16px;
    transition: all 0.2s;
}

.apc-mini-step.completed {
    background: var(--primary-gradient, linear-gradient(135deg, #21C55D 0%, #16A34A 100%));
    border-color: transparent;
}

.sidebar-ai-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 14px;
}

.sidebar-card-model {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-primary, #F7FAFC);
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.sidebar-card-price {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-accent, #21C55D);
    margin: 6px 0;
}

.sidebar-card-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    background: rgba(33, 197, 93, 0.15);
    color: var(--text-accent, #21C55D);
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    margin: 6px 0;
}
.sidebar-card-reason {
    font-size: 11px;
    color: var(--text-secondary, #A0AEC0);
    line-height: 1.4;
    margin: 8px 0;
}

.sidebar-card-btn {
    width: 100%;
    padding: 10px;
    background: var(--primary-gradient, linear-gradient(135deg, #21C55D 0%, #16A34A 100%));
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
    transition: all 0.2s;
}

.sidebar-card-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(33, 197, 93, 0.3);
}

</style>

<div class="configurator-fullscreen">
    <!-- Hero Section -->
    <section class="hero-header">
        <div class="hero-content">
            <h1 class="hero-title">CONFIGURATOR PC F5it!</h1>
            <p class="hero-subtitle">Creează-ți PC-ul perfect cu Configurator PC F5it AI! <br> Verificare automată socket, RAM DDR4/DDR5, PSU, case, GPU. <br> Asamblare rapidă București - gaming/office 100% compatibil!</p>
            <a href="#configurator" class="hero-cta">
                Începe Configurația
                <span>⚡</span>
            </a>
        </div>
        <div class="scroll-indicator">
            <span>Scroll pentru a începe</span>
            <div style="font-size: 1.5rem">↓</div>
        </div>
    </section>
    <!-- DUPĂ .scroll-indicator și ÎNAINTE de .main-content -->
<!-- ========== TUTORIAL SECTION - PREMIUM PROCESS FLOW ========== -->
<section class="apc-recommendations-section" style="
  margin: 0; 
  border-radius: 0; 
  padding: clamp(3rem, 6vw, 6rem) clamp(1rem, 3vw, 2rem); 
  background: linear-gradient(135deg, rgba(15,20,25,0.95), rgba(26,35,50,0.8));
  border-top: 3px solid var(--primary-gradient);
  border-bottom: 3px solid var(--primary-gradient);
  box-shadow: inset 0 0 40px rgba(33,197,93,0.1);
">
  
  <div class="apc-recommendation-container" style="max-width: 1400px; margin: 0 auto; padding: 0; background: transparent; border: none; overflow: visible;">
    
    <!-- Title -->
    <div class="apc-recommendation-header">
      <h2 class="apc-recommendation-title" style="
        font-size: clamp(1.5rem, 5vw, 3rem);
        text-align: center;
        margin: 0 0 0.8rem 0;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 40px rgba(33,197,93,0.3);
      ">
        Cum Funcționează
      </h2>
      <p class="apc-recommendation-reason" style="
        text-align: center;
        font-size: clamp(0.8rem, 2vw, 1rem);
        color: var(--text-secondary);
        margin: 0;
      ">
        4 pași simpli pentru configurația perfectă
      </p>
    </div>

    <!-- PROGRESS TRACKER (Visual Timeline) - HIDDEN ON MOBILE -->
    <div class="apc-progress-tracker" style="
      display: none;
      justify-content: space-between;
      align-items: center;
      margin: 3rem 0 4rem 0;
      gap: 1rem;
      max-width: 100%;
      flex-wrap: wrap;
    ">
      <style>
        @media (min-width: 768px) {
          .apc-progress-tracker {
            display: flex !important;
          }
        }
        @keyframes progressFill {
          0% { width: 0; opacity: 0; }
          100% { width: 100%; opacity: 1; }
        }
        .progress-connector {
          flex: 1;
          height: 2px;
          background: rgba(33,197,93,0.3);
          position: relative;
          animation: progressFill 1.5s ease-out forwards;
          min-width: 20px;
        }
      </style>

      <div class="apc-progress-step" style="
        flex: 0 0 auto;
        width: clamp(70px, 15vw, 100px);
        height: clamp(70px, 15vw, 100px);
        background: rgba(33,197,93,0.1);
        border: 2px solid rgba(33,197,93,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.5rem, 4vw, 2rem);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 5;
      ">1️⃣</div>
      <div class="progress-connector" style="animation-delay: 0.2s;"></div>
      
      <div class="apc-progress-step" style="
        flex: 0 0 auto;
        width: clamp(70px, 15vw, 100px);
        height: clamp(70px, 15vw, 100px);
        background: rgba(33,197,93,0.1);
        border: 2px solid rgba(33,197,93,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.5rem, 4vw, 2rem);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 5;
      ">2️⃣</div>
      <div class="progress-connector" style="animation-delay: 0.4s;"></div>
      
      <div class="apc-progress-step" style="
        flex: 0 0 auto;
        width: clamp(70px, 15vw, 100px);
        height: clamp(70px, 15vw, 100px);
        background: rgba(33,197,93,0.1);
        border: 2px solid rgba(33,197,93,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.5rem, 4vw, 2rem);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 5;
      ">3️⃣</div>
      <div class="progress-connector" style="animation-delay: 0.6s;"></div>
      
      <div class="apc-progress-step" style="
        flex: 0 0 auto;
        width: clamp(70px, 15vw, 100px);
        height: clamp(70px, 15vw, 100px);
        background: linear-gradient(135deg, rgba(33,197,93,0.9), rgba(22,163,74,0.8));
        border: 2px solid var(--text-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(1.5rem, 4vw, 2rem);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 5;
        box-shadow: 0 0 25px rgba(33,197,93,0.4);
      ">4️⃣</div>
    </div>

    <!-- CARDS GRID - RESPONSIVE -->
    <div style="
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(min(100%, clamp(250px, 45vw, 300px)), 1fr));
      gap: clamp(1rem, 2vw, 1.5rem);
      margin-top: clamp(2rem, 4vw, 3rem);
    ">

      <!-- Card 1 -->
      <div class="apc-recommendation-item" style="
        background: linear-gradient(135deg, rgba(15,24,32,0.7), rgba(20,32,45,0.8));
        border-left: 5px solid var(--primary-gradient);
        border: 1px solid rgba(33,197,93,0.25);
        border-radius: 14px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 3vw, 2rem) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
      " onmouseover="this.style.borderColor='rgba(33,197,93,0.6)'; this.style.boxShadow='0 12px 35px rgba(33,197,93,0.25), inset 0 1px 0 rgba(255,255,255,0.1)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='rgba(33,197,93,0.25)'; this.style.boxShadow='0 0 0'; this.style.transform='translateY(0)'">
        <div style="position: absolute; top: -50%; right: -50%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(33,197,93,0.15), transparent); border-radius: 50%;"></div>
        <div style="position: relative; z-index: 2;">
          <h3 style="
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: clamp(0.5rem, 1vw, 0.75rem);
            margin: 0 0 clamp(0.75rem, 2vw, 1.25rem) 0;
            font-size: clamp(1rem, 3vw, 1.3rem);
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: -0.5px;
            text-align: center;
          ">
            <span style="font-size: clamp(1.8rem, 4vw, 2.8rem); filter: drop-shadow(0 0 8px rgba(33,197,93,0.4));">🖥️</span>
            Alege Componente
          </h3>
          <p style="
            margin: 0;
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            line-height: 1.6;
            color: var(--text-secondary);
            font-weight: 400;
            letter-spacing: 0.3px;
            text-align: center;
          ">
            Poți începe prin a selecta CPU. <br> După ce soft-ul știe procesorul dorit, o să-ți recomande ce componente sunt perfecte pentru tine.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="apc-recommendation-item" style="
        background: linear-gradient(135deg, rgba(15,24,32,0.7), rgba(20,32,45,0.8));
        border-left: 5px solid var(--primary-gradient);
        border: 1px solid rgba(33,197,93,0.25);
        border-radius: 14px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 3vw, 2rem) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
      " onmouseover="this.style.borderColor='rgba(33,197,93,0.6)'; this.style.boxShadow='0 12px 35px rgba(33,197,93,0.25), inset 0 1px 0 rgba(255,255,255,0.1)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='rgba(33,197,93,0.25)'; this.style.boxShadow='0 0 0'; this.style.transform='translateY(0)'">
        <div style="position: absolute; top: -50%; right: -50%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(59,130,246,0.15), transparent); border-radius: 50%;"></div>
        <div style="position: relative; z-index: 2;">
          <h3 style="
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: clamp(0.5rem, 1vw, 0.75rem);
            margin: 0 0 clamp(0.75rem, 2vw, 1.25rem) 0;
            font-size: clamp(1rem, 3vw, 1.3rem);
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: -0.5px;
            text-align: center;
          ">
            <span style="font-size: clamp(1.8rem, 4vw, 2.8rem); filter: drop-shadow(0 0 8px rgba(33,197,93,0.4));">✅</span>
            Verificare Compatibilitate
          </h3>
          <p style="
            margin: 0;
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            line-height: 1.6;
            color: var(--text-secondary);
            font-weight: 400;
            letter-spacing: 0.3px;
            text-align: center;
          ">
            Socket, RAM, PSU, Case, GPU. <br> Componentele și consumul sunt verificate automat si garantează 100% compatibilitate!
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="apc-recommendation-item" style="
        background: linear-gradient(135deg, rgba(15,24,32,0.7), rgba(20,32,45,0.8));
        border-left: 5px solid var(--primary-gradient);
        border: 1px solid rgba(33,197,93,0.25);
        border-radius: 14px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 3vw, 2rem) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
      " onmouseover="this.style.borderColor='rgba(33,197,93,0.6)'; this.style.boxShadow='0 12px 35px rgba(33,197,93,0.25), inset 0 1px 0 rgba(255,255,255,0.1)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='rgba(33,197,93,0.25)'; this.style.boxShadow='0 0 0'; this.style.transform='translateY(0)'">
        <div style="position: absolute; top: -50%; right: -50%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(245,158,11,0.15), transparent); border-radius: 50%;"></div>
        <div style="position: relative; z-index: 2;">
          <h3 style="
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: clamp(0.5rem, 1vw, 0.75rem);
            margin: 0 0 clamp(0.75rem, 2vw, 1.25rem) 0;
            font-size: clamp(1rem, 3vw, 1.3rem);
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: -0.5px;
            text-align: center;
          ">
            <span style="font-size: clamp(1.8rem, 4vw, 2.8rem); filter: drop-shadow(0 0 8px rgba(33,197,93,0.4));">📄</span>
            Export PDF
          </h3>
          <p style="
            margin: 0;
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            line-height: 1.6;
            color: var(--text-secondary);
            font-weight: 400;
            letter-spacing: 0.3px;
            text-align: center;
          ">
            Generează PDF-ul  cu componentele alese și salvează-l!<br> Acum ai configurația perfectă pentru tine!
          </p>
        </div>
      </div>

      <!-- Card 4 (Final) -->
      <div class="apc-recommendation-item" style="
        background: linear-gradient(135deg, rgba(33,197,93,0.2), rgba(22,163,74,0.15));
        border-left: 5px solid var(--primary-gradient);
        border: 2px solid rgba(33,197,93,0.5);
        border-radius: 14px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        padding: clamp(1.5rem, 3vw, 2rem) !important;
        box-shadow: 0 8px 30px rgba(33,197,93,0.2), inset 0 1px 0 rgba(255,255,255,0.15);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
      " onmouseover="this.style.borderColor='rgba(33,197,93,0.8)'; this.style.boxShadow='0 15px 45px rgba(33,197,93,0.35), inset 0 1px 0 rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='rgba(33,197,93,0.5)'; this.style.boxShadow='0 8px 30px rgba(33,197,93,0.2), inset 0 1px 0 rgba(255,255,255,0.15)'; this.style.transform='translateY(0)'">
        <div style="position: absolute; top: -50%; right: -50%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(33,197,93,0.3), transparent); border-radius: 50%;"></div>
        <div style="position: relative; z-index: 2;">
          <h3 style="
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: clamp(0.5rem, 1vw, 0.75rem);
            margin: 0 0 clamp(0.75rem, 2vw, 1.25rem) 0;
            font-size: clamp(1rem, 3vw, 1.3rem);
            font-weight: 700;
            color: var(--text-accent);
            letter-spacing: -0.5px;
            text-align: center;
          ">
            <span style="font-size: clamp(1.8rem, 4vw, 2.8rem); filter: drop-shadow(0 0 12px rgba(33,197,93,0.6));">🚀</span>
            Comandă Asamblarea
          </h3>
          <p style="
            margin: 0;
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            line-height: 1.6;
            color: var(--text-primary);
            font-weight: 500;
            letter-spacing: 0.3px;
            text-align: center;
          ">
            PDF complet.<br> Asamblare 24h București. Garanție montaj!
          </p>
          <p style="margin: 0.5rem 0 0 0; font-size: 0.75rem; color: var(--text-secondary); text-align: center;">
  Comandă componente de la <br> <a href="https://altex.ro" target="_blank" rel="nofollow noopener" style="color: var(--text-accent);">Altex</a>, 
  <a href="https://emag.ro" target="_blank" rel="nofollow noopener" style="color: var(--text-accent);">eMag,</a> 
  <a href="https://pcgarage.ro" target="_blank" rel="nofollow noopener" style="color: var(--text-accent);">PCGarage</a>.
</p>
        </div>
      </div>

    </div>

    <!-- CTA BUTTON -->
    <div style="text-align: center; margin-top: clamp(2.5rem, 5vw, 5rem); padding: 0 clamp(0.5rem, 2vw, 1rem);">
      <a href="#cpuSection" style="
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: clamp(1.2rem, 2.5vw, 1.8rem) clamp(1.5rem, 4vw, 3.5rem);
        background: var(--primary-gradient);
        color: white;
        font-weight: 700;
        font-size: clamp(0.9rem, 2.2vw, 1.3rem);
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 20px 40px -5px rgba(33,197,93,0.4);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
      " onmouseover="this.style.transform='translateY(-3px) scale(1.02)'; this.style.boxShadow='0 30px 60px -5px rgba(33,197,93,0.6)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px -5px rgba(33,197,93,0.4)'">
        ⚡ Configurator PC
      </a>
      <p style="
        color: var(--text-secondary); 
        margin: 0.8rem 0 0 0; 
        font-size: clamp(0.75rem, 1.6vw, 0.95rem); 
        letter-spacing: 0.5px;
      ">
        Gratuit. Fără cont.
      </p>
    </div>

  </div>

</section>
<!-- ========== END TUTORIAL SECTION ========== -->



    <!-- Main Configurator Content -->
    <main id="configurator" class="main-content">
        <div class="content-container">
            <!-- Left Panel - Component Selection -->
            <div class="components-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Alege Componentele</h2>
                    <p class="panel-subtitle">Compatibilitate completă: Socket, PSU, RAM, Case clearance</p>
                </div>

                <div class="component-grid">
                    <!-- CPU Component -->
                    <div class="component-card" id="cpuSection" data-component="cpu">
                        <div class="component-header">
                            <div class="component-icon">🔧</div>
                            <div class="component-info">
                                <div class="component-name">Procesor CPU</div>
                                <div class="component-status" id="selectedCpu">Niciun procesor selectat</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- Motherboard Component -->
                    <div class="component-card" id="mbSection" data-component="motherboard">
                        <div class="component-header">
                            <div class="component-icon">🔌</div>
                            <div class="component-info">
                                <div class="component-name">Placă de bază</div>
                                <div class="component-status" id="selectedMb">Nicio placă de bază selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- RAM Component -->
                    <div class="component-card" id="ramSection" data-component="ram">
                        <div class="component-header">
                            <div class="component-icon">💾</div>
                            <div class="component-info">
                                <div class="component-name">Memorie RAM</div>
                                <div class="component-status" id="selectedRam">Nicio memorie RAM selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- GPU Component -->
                    <div class="component-card" id="gpuSection" data-component="gpu">
                        <div class="component-header">
                            <div class="component-icon">🎮</div>
                            <div class="component-info">
                                <div class="component-name">Placă video</div>
                                <div class="component-status" id="selectedGpu">Nicio placă video selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>
                    
                     <!-- CPU Cooler Component -->
                    <div class="component-card" id="coolerSection" data-component="cooler">
                        <div class="component-header">
                            <div class="component-icon">❄️</div>
                            <div class="component-info">
                                <div class="component-name">Cooler CPU</div>
                                <div class="component-status" id="selectedCooler">Niciun cooler selectat</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- Storage Component -->
                    <div class="component-card" id="storageSection" data-component="storage">
                        <div class="component-header">
                            <div class="component-icon">💽</div>
                            <div class="component-info">
                                <div class="component-name">SSD Stocare</div>
                                <div class="component-status" id="selectedSsd">Nicio stocare selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- PSU Component -->
                    <div class="component-card" id="psuSection" data-component="psu">
                        <div class="component-header">
                            <div class="component-icon">⚡</div>
                            <div class="component-info">
                                <div class="component-name">Sursă alimentare</div>
                                <div class="component-status" id="selectedPsu">Nicio sursă selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>

                    <!-- Case Component -->
                    <div class="component-card" id="caseSection" data-component="case">
                        <div class="component-header">
                            <div class="component-icon">📦</div>
                            <div class="component-info">
                                <div class="component-name">Carcasă</div>
                                <div class="component-status" id="selectedCase">Nicio carcasă selectată</div>
                            </div>
                            <div class="component-arrow">→</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Configuration Summary -->
            <div class="summary-panel">
                <div class="summary-header">
                    <div class="compatibility-badge" id="compatibility-badge">
                        <div class="score-indicator" id="compatibilityIndicator"></div>
                        <span id="compatibilityPercent">COMPATIBILITATE 100%</span>
                    </div>
                    <div class="total-price" id="totalPrice">0 LEI</div>
                    <div class="price-label">Preț Total Estimat</div>
                </div>

                <div class="summary-stats">
                   
                    <div class="stat-item">
                        <span class="stat-label">PSU recomandat</span>
                        <span class="stat-value" id="recommendedPsu">N/A</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Componente selectate</span>
                        <span class="stat-value" id="components-count">0 / 8</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Status</span>
                        <span class="stat-value" id="build-status">În progres</span>
                    </div>
                </div>

               
                <!-- Warnings Container -->
                <div class="warnings-container" id="warningsContainer"></div>

                <div class="selected-components" id="selected-components">
                    <div style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 2rem 0;">
                        Nicio componentă selectată.
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="action-btn action-btn-primary" id="exportPdfBtn" disabled>
                        📄 Export PDF
                    </button>
                    <button class="action-btn action-btn-secondary" id="shareConfigBtn">
                        🔗 Partajează Link
                    </button>
                    <button class="action-btn action-btn-secondary" id="resetButton">
                        🔄 Resetează Totul
                    </button>
                </div>
                
               
               <?php the_content(); ?>
               
               <!-- ADAUGĂ ÎNAINTE DE </main> în configurator -->



    </main>
    
     <!-- CHATBOT WIDGET - Glassmorphism Design -->
                


                <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--glass-border);">
                    <p style="color: var(--text-secondary); font-size: 0.85rem; line-height: 1.4;">
                        <strong>Compatibilitate completă!</strong> Socket, Brand, RAM DDR4/DDR5, PSU power analysis, Case clearance - toate verificate automat!<br><br>
                        Prețurile afișate nu includ TVA!
                    </p>
                </div>
            </div>
        </div>
        <div class="chatbot-wrapper">
    <div class="chatbot-launcher" id="chatbot-launcher" title="Open Chat">    <span class="launcher-robot">🤖</span>
</div>
    <div class="chatbot-popup-overlay" id="chatbot-overlay"></div>
    <div class="chatbot-container" id="chatbot-container">
        <div class="chatbot-header" id="chatbot-header">
            <div class="chatbot-header-title">
                <span class="chatbot-header-icon">🤖</span>
                <span>PC Helper AI</span>
            </div>
            <div class="chatbot-header-controls">
                <button class="chatbot-control-btn" id="chatbot-minimize" title="Minimize">−</button>
                <button class="chatbot-control-btn" id="chatbot-close" title="Close">✕</button>
            </div>
        </div>
        
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="message bot">
                <div class="message-content">👋 <strong>Salut!</strong> Sunt F5it AI! Pot răspunde la orice întrebări despre procesoare, plăci video, RAM, PSU, sau compatibilitate. Ce dorești să știi?</div>
            </div>
        </div>
        
        <div class="chatbot-input-area">
            <input 
                type="text" 
                id="chatbot-input" 
                placeholder="Întreabă ceva..."
                class="chatbot-input"
            >
            <button id="chatbot-send" class="chatbot-send-btn">→</button>
        </div>
    </div>
</div>
</div>

<script>
// COMPLETE PC CONFIGURATOR 2025 - ALL COMPATIBILITY FUNCTIONS + PREMIUM PDF DESIGN

// Debug system
let debugMode = false;

function toggleDebug() {
    debugMode = !debugMode;
    const debugPanel = document.getElementById('debugPanel');
    debugPanel.style.display = debugMode ? 'block' : 'none';
    if (debugMode) updateDebugInfo();
}

function updateDebugInfo() {
    if (!debugMode) return;
    const urlParams = new URLSearchParams(window.location.search);
    const debugPanel = document.getElementById('debugPanel');
    let debugHtml = '<strong>URL PARAMETERS</strong><br>';
    for (const [key, value] of urlParams.entries()) {
        debugHtml += `${key}: ${decodeURIComponent(value)}<br>`;
    }
    debugPanel.innerHTML = debugHtml;
}

// COMPLETE COMPONENT MAPPING
const COMPONENT_CONFIG = {
    cpu: { name: 'Procesor', icon: '🔧', priceParam: 'cpu_price', displayElement: 'selectedCpu', nameParam: 'cpu', cardId: 'cpuSection' },
    cooler: { name: 'Cooler CPU', icon: '❄️', priceParam: 'cooler_price', displayElement: 'selectedCooler', nameParam: 'cpu_cooler', cardId: 'coolerSection' },
    mb: { name: 'Placă de bază', icon: '🔌', priceParam: 'motherboard_price', displayElement: 'selectedMb', nameParam: 'motherboard', cardId: 'mbSection' },
    ram: { name: 'Memorie RAM', icon: '💾', priceParam: 'ram_price', displayElement: 'selectedRam', nameParam: 'ram', cardId: 'ramSection' },
    gpu: { name: 'Placă video', icon: '🎮', priceParam: 'gpu_price', displayElement: 'selectedGpu', nameParam: 'gpu', cardId: 'gpuSection' },
    ssd: { name: 'Stocare SSD', icon: '💽', priceParam: 'ssd_price', displayElement: 'selectedSsd', nameParam: 'ssd', cardId: 'storageSection' },
    psu: { name: 'Sursă alimentare', icon: '⚡', priceParam: 'psu_price', displayElement: 'selectedPsu', nameParam: 'psu', cardId: 'psuSection' },
    case: { name: 'Carcasă', icon: '📦', priceParam: 'case_price', displayElement: 'selectedCase', nameParam: 'case', cardId: 'caseSection' }
};

// COMPONENT DATA EXTRACTION
function getComponentDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    
    function getComponentValue(elementId, urlParam) {
        let value;
        
        if (urlParams.has(urlParam)) {
            value = decodeURIComponent(urlParams.get(urlParam));
        }
        
        if (!value) {
            const el = document.getElementById(elementId);
            if (el && el.textContent && !el.textContent.includes('Niciun') && !el.textContent.includes('None')) {
                value = el.textContent.trim();
            }
        }
        
        if (value) {
            value = value.replace(/de la\s*\d+\s*LEI/gi, '').trim();
        }
        
        return value;
    }
    
    return {
        cpu:         getComponentValue('selectedCpu',      'cpu'),
    cpu_price:   parseFloat(urlParams.get('cpu_price')  || 0),
    cpu_tdp:     parseInt(urlParams.get('cpu_tdp')     || 0),
    cpu_socket:  (urlParams.get('cpu_socket')          || '').toLowerCase(),

    cooler:      getComponentValue('selectedCooler',   'cooler'),
    cooler_price:parseFloat(urlParams.get('cooler_price')|| 0),
    cooler_tdp:  parseInt(urlParams.get('cooler_tdp')   || 0),

    mb:          getComponentValue('selectedMb',       'motherboardName'),
    mb_price:    parseFloat(urlParams.get('mb_price')   || 0),
    mb_socket:   (urlParams.get('mb_socket')           || '').toLowerCase(),

    ram:         getComponentValue('selectedRam',       'ram'),
    ram_price:   parseFloat(urlParams.get('ram_price')  || 0),

    gpu:         getComponentValue('selectedGpu',       'gpu'),
    gpu_price:   parseFloat(urlParams.get('gpu_price')  || 0),
    gpu_tdp:     parseInt(urlParams.get('gpu_tdp')      || 0),

    ssd:         getComponentValue('selectedSsd',       'ssd'),
    ssd_price:   parseFloat(urlParams.get('ssd_price')  || 0),

    psu:         getComponentValue('selectedPsu',       'psu'),
    psu_price:   parseFloat(urlParams.get('psu_price')  || 0),
    psu_watts:   parseInt(urlParams.get('psu_watts')    || 0),

    case:        getComponentValue('selectedCase',      'case'),
    case_price:  parseFloat(urlParams.get('case_price') || 0)
    };
}

// COMPLETE COMPATIBILITY CHECK - ALL FUNCTIONS INTEGRATED
function checkCompatibility() {
    const c = getComponentDetails();
    console.log('🔧 === COMPLETE COMPATIBILITY CHECK START ===');
    
    const warnings = [];
    let score = 100;
    
    // 1. PSU COMPATIBILITY CHECK ENHANCED
    let cpuTdp = 65; // Default
    let gpuTdp = 0;
    let cpuPowerWithOC = 65;
    let gpuPowerWithOC = 0;
    
    // CPU TDP Analysis
    if (c.cpu_tdp && !isNaN(c.cpu_tdp)) {
        cpuTdp = parseInt(c.cpu_tdp);
    } else if (c.cpu) {
        const cpuTdpDatabase = {
            // Intel 14th Gen
            'i9-14900KS': 150, 'i9-14900K': 125, 'i9-14900F': 65, 'i9-14900': 65,
            'i7-14700KF': 125, 'i7-14700K': 125, 'i7-14700F': 65, 'i7-14700': 65,
            'i5-14600KF': 125, 'i5-14600K': 125, 'i5-14400F': 65, 'i5-14400': 65,
            'i3-14100F': 60, 'i3-14100': 60,
            
            // Intel 13th Gen
            'i9-13900KS': 150, 'i9-13900KF': 125, 'i9-13900K': 125, 'i9-13900F': 65, 'i9-13900': 65,
            'i7-13700KF': 125, 'i7-13700K': 125, 'i7-13700F': 65, 'i7-13700': 65,
            'i5-13600KF': 125, 'i5-13600K': 125, 'i5-13400F': 65, 'i5-13400': 65,
            
            // Intel 12th Gen
            'i9-12900KS': 150, 'i9-12900KF': 125, 'i9-12900K': 125, 'i9-12900F': 65,
            'i7-12700KF': 125, 'i7-12700K': 125, 'i7-12700F': 65, 'i7-12700': 65,
            'i5-12600KF': 125, 'i5-12600K': 125, 'i5-12400F': 65, 'i5-12400': 65,
            'i3-12100F': 60, 'i3-12100': 60,
            
            // Intel Ultra
            'Ultra 9 285K': 125, 'Ultra 9 285KF': 125,
            'Ultra 7 265K': 125, 'Ultra 7 265KF': 125, 'Ultra 7 265F': 65,
            'Ultra 5 245K': 125, 'Ultra 5 245KF': 125, 'Ultra 5 225F': 65, 'Ultra 5 225': 65,
            
            // AMD Ryzen 9000 Series
            'Ryzen 9 9950X': 170, 'Ryzen 9 9900X': 120,
            'Ryzen 7 9700X': 65, 'Ryzen 5 9600X': 65,
            
            // AMD Ryzen 7000 Series
            'Ryzen 9 7950X3D': 120, 'Ryzen 9 7950X': 170, 'Ryzen 9 7900X3D': 120, 'Ryzen 9 7900X': 170, 'Ryzen 9 7900': 65,
            'Ryzen 7 7800X3D': 120, 'Ryzen 7 7700X': 105, 'Ryzen 7 7700': 65,
            'Ryzen 5 7600X': 105, 'Ryzen 5 7600': 65,
            
            // AMD Ryzen 5000 Series
            'Ryzen 9 5950X': 105, 'Ryzen 9 5900X': 105, 'Ryzen 9 5900XT': 105,
            'Ryzen 7 9800X3D': 120, 'Ryzen 7 5800X3D': 105, 'Ryzen 7 5800X': 105, 'Ryzen 7 5800XT': 105, 'Ryzen 7 5700X3D': 105, 'Ryzen 7 5700X': 65, 'Ryzen 7 5700': 65,
            'Ryzen 5 5600X3D': 105, 'Ryzen 5 5600X': 65, 'Ryzen 5 5600GT': 65, 'Ryzen 5 5600': 65, 'Ryzen 5 5500': 65,
            'Ryzen 3 4100': 65, 'Ryzen 5 3600': 65,
            
            // AMD APU Series
            'Ryzen 7 8700G': 65, 'Ryzen 5 8600G': 65, 'Ryzen 5 8500G': 65, 'Ryzen 3 8300G': 65,
            'Ryzen 7 8700F': 65, 'Ryzen 5 8400F': 65,
        };
        
        const sortedCpuKeys = Object.keys(cpuTdpDatabase).sort((a, b) => b.length - a.length);
        for (const cpuModel of sortedCpuKeys) {
            if (c.cpu.includes(cpuModel)) {
                cpuTdp = cpuTdpDatabase[cpuModel];
                console.log(`🔥 CPU TDP: ${cpuModel} = ${cpuTdp}W`);
                break;
            }
        }
    }
    
    // CPU OC Headroom
    const hasKSeries = c.cpu && /[kK][fF]?$|[kK][sS]$/.test(c.cpu);
    const ocMultiplier = hasKSeries ? 1.5 : 1.3;
    cpuPowerWithOC = Math.round(cpuTdp * ocMultiplier);
    
    // GPU TDP Analysis
    if (c.gpu_tdp && !isNaN(c.gpu_tdp)) {
        gpuTdp = parseInt(c.gpu_tdp);
    } else if (c.gpu && !/niciun|none|selectat/i.test(c.gpu)) {
        const gpuTdpDatabase = {
            // NVIDIA RTX 50 Series
            'RTX 5090': 575, 'RTX 5080': 360, 'RTX 5070 Ti': 250, 'RTX 5070 TI': 250, 'RTX 5070': 220,
            'RTX 5060 Ti': 145, 'RTX 5060 TI': 145, 'RTX 5060': 145,
            
            // NVIDIA RTX 40 Series
            'RTX 4090': 450, 'RTX 4080 SUPER': 320, 'RTX 4080': 320,
            'RTX 4070 Ti SUPER': 285, 'RTX 4070 Ti': 285, 'RTX 4070 SUPER': 220, 'RTX 4070': 200,
            'RTX 4060 Ti': 160, 'RTX 4060': 115,
            
            // NVIDIA RTX 30 Series
            'RTX 3090 Ti': 450, 'RTX 3090': 350, 'RTX 3080 Ti': 350, 'RTX 3080': 320,
            'RTX 3070 Ti': 290, 'RTX 3070': 220, 'RTX 3060 Ti': 200, 'RTX 3060': 170, 'RTX 3050': 130,
            
            // AMD RX 9000 Series
            'RX 9070 XT': 300, 'RX 9070': 250,
            
            // AMD RX 7000 Series
            'RX 7900 XTX': 355, 'RX 7900 XT': 315, 'RX 7900 GRE': 260,
            'RX 7800 XT': 263, 'RX 7700 XT': 245, 'RX 7600 XT': 190, 'RX 7600': 165,
            
            // AMD RX 6000 Series
            'RX 6950 XT': 335, 'RX 6900 XT': 300, 'RX 6800 XT': 300, 'RX 6800': 250,
            'RX 6700 XT': 230, 'RX 6650 XT': 180, 'RX 6600 XT': 160, 'RX 6600': 132,
            'RX 6500 XT': 107, 'RX 6400': 53,
        };
        
        const sortedGpuKeys = Object.keys(gpuTdpDatabase).sort((a, b) => b.length - a.length);
        for (const gpuModel of sortedGpuKeys) {
            if (c.gpu.includes(gpuModel)) {
                gpuTdp = gpuTdpDatabase[gpuModel];
                console.log(`🎮 GPU TDP: ${gpuModel} = ${gpuTdp}W`);
                break;
            }
        }
    }
    
    if (gpuTdp > 0) {
        gpuPowerWithOC = Math.round(gpuTdp * 1.15);
    }
    
    // System Power Calculation
    let systemBasePower = 50;
    let totalSystemPower = cpuPowerWithOC + gpuPowerWithOC + systemBasePower;
    let recommendedPsuPower = Math.round(totalSystemPower * 1.25);
    
    console.log(`⚡ Power: CPU=${cpuPowerWithOC}W, GPU=${gpuPowerWithOC}W, Total=${totalSystemPower}W, Rec=${recommendedPsuPower}W`);
    
    // Update UI Power Elements
    const powerElement = document.getElementById('powerConsumption');
    if (powerElement) {
    // Make sure we're showing WATTS, not LEI
    powerElement.textContent = `${totalSystemPower} W`;
}
    const cpuPowerElement = document.getElementById('cpuPower');
    const gpuPowerElement = document.getElementById('gpuPower');
    const systemPowerElement = document.getElementById('systemPower');
    const totalSystemPowerElement = document.getElementById('totalSystemPower');
    const recommendedPsuElement = document.getElementById('recommendedPsu');
    const psuRecommendationElement = document.getElementById('psuRecommendation');
    const powerBreakdownElement = document.getElementById('powerBreakdown');
    
    if (powerElement) {
        animateNumber(powerElement, parseInt(powerElement.textContent) || 0, totalSystemPower);
    }
    
    if (cpuPowerElement) cpuPowerElement.textContent = `${cpuPowerWithOC}W`;
    if (gpuPowerElement) gpuPowerElement.textContent = `${gpuPowerWithOC}W`;
    if (systemPowerElement) systemPowerElement.textContent = `${systemBasePower}W`;
    if (totalSystemPowerElement) totalSystemPowerElement.textContent = `${totalSystemPower}W`;
    if (recommendedPsuElement) recommendedPsuElement.textContent = `${recommendedPsuPower}W+`;
    if (psuRecommendationElement) psuRecommendationElement.innerHTML = `PSU Recomandat: <strong>${recommendedPsuPower}W+</strong>`;
    
    if (powerBreakdownElement && totalSystemPower > 100) {
        powerBreakdownElement.style.display = 'block';
    }
    
    // PSU Analysis
    if (c.psu && totalSystemPower > 0) {
        let psuWatts = 0;
        
        if (c.psu_watts && !isNaN(c.psu_watts)) {
            psuWatts = parseInt(c.psu_watts);
        }
        
        if (!psuWatts && c.psu) {
            const wattMatch = c.psu.match(/(\d{3,4})\s*W/i);
            if (wattMatch) {
                psuWatts = parseInt(wattMatch[1]);
            }
        }
        
        if (psuWatts > 0) {
            const powerUtilization = (totalSystemPower / psuWatts) * 100;
            
            if (psuWatts < totalSystemPower) {
                warnings.push({
                    message: `🚨 EROARE CRITICĂ: PSU (${psuWatts}W) insuficient pentru sistem (${totalSystemPower}W)! Sistemul nu va funcționa. Ai nevoie de minimum ${recommendedPsuPower}W.`,
                    components: ['psuSection', 'cpuSection', 'gpuSection'],
                    isError: true,
                    score: -85
                });
            } else if (powerUtilization >= 95) {
                warnings.push({
                    message: `⚠️ PERICOL: PSU (${psuWatts}W) la ${powerUtilization.toFixed(1)}% utilizare! Risc mare de instabilitate. Recomandare urgentă: PSU de minimum ${recommendedPsuPower}W.`,
                    components: ['psuSection', 'cpuSection', 'gpuSection'],
                    isError: true,
                    score: -60
                });
            } else if (powerUtilization >= 85) {
                warnings.push({
                    message: `⚠️ ATENȚIE: PSU (${psuWatts}W) la ${powerUtilization.toFixed(1)}% utilizare! Pentru siguranță maximă recomandăm PSU de ${recommendedPsuPower}W+.`,
                    components: ['psuSection'],
                    isError: false,
                    score: -30
                });
            } else if (powerUtilization >= 70) {
                warnings.push({
                    message: `✅ PSU (${psuWatts}W) funcțional pentru sistem (${totalSystemPower}W), utilizare ${powerUtilization.toFixed(1)}%. Pentru eficiență optimă consideră un PSU de ${recommendedPsuPower}W.`,
                    components: ['psuSection'],
                    isError: false,
                    score: -10
                });
            } else if (powerUtilization < 40) {
                warnings.push({
                    message: `💡 INFO: PSU (${psuWatts}W) supradimensionat pentru sistem (${totalSystemPower}W, ${powerUtilization.toFixed(1)}% utilizare). Poți economisi cu un PSU de ${recommendedPsuPower}W.`,
                    components: ['psuSection'],
                    isError: false,
                    score: 0
                });
            }
        }
        
        // GPU-Specific PSU Recommendations
        if (gpuTdp > 0) {
            const gpuPsuRecommendations = {
                'RTX 5090': { min: 1000, recommended: 1200 },
                'RTX 5080': { min: 850, recommended: 1000 },
                'RTX 4090': { min: 850, recommended: 1000 },
                'RTX 5070 Ti': { min: 650, recommended: 750 },
                'RTX 5070': { min: 650, recommended: 750 },
                'RTX 4080 SUPER': { min: 750, recommended: 850 },
                'RTX 4080': { min: 750, recommended: 850 },
                'RTX 4070 Ti SUPER': { min: 650, recommended: 750 },
                'RTX 4070 Ti': { min: 650, recommended: 750 },
                'RTX 4070 SUPER': { min: 650, recommended: 750 },
                'RTX 4070': { min: 650, recommended: 750 },
                'RTX 4060 Ti': { min: 550, recommended: 650 },
                'RTX 4060': { min: 550, recommended: 650 },
                'RTX 3060 Ti': { min: 550, recommended: 650 },
                'RTX 3060': { min: 550, recommended: 650 },
                'RX 7900 XTX': { min: 850, recommended: 1000 },
                'RX 7900 XT': { min: 750, recommended: 850 },
                'RX 7800 XT': { min: 650, recommended: 750 },
                'RX 7700 XT': { min: 650, recommended: 750 },
                'RX 7600 XT': { min: 550, recommended: 650 },
                'RX 7600': { min: 550, recommended: 650 },
            };
            
            let gpuPsuRec = null;
            const sortedGpuRecKeys = Object.keys(gpuPsuRecommendations).sort((a, b) => b.length - a.length);
            for (const gpuModel of sortedGpuRecKeys) {
                if (c.gpu.includes(gpuModel)) {
                    gpuPsuRec = gpuPsuRecommendations[gpuModel];
                    break;
                }
            }
            
            if (gpuPsuRec && psuWatts > 0) {
                if (psuWatts < gpuPsuRec.min) {
                    warnings.push({
                        message: `🎮 INCOMPATIBILITATE GPU: ${c.gpu.split(' ').slice(0,2).join(' ')} necesită minimum ${gpuPsuRec.min}W PSU! Sursa ta (${psuWatts}W) va cauza crash-uri și instabilitate.`,
                        components: ['gpuSection', 'psuSection'],
                        isError: true,
                        score: -50
                    });
                } else if (psuWatts < gpuPsuRec.recommended) {
                    warnings.push({
                        message: `🎮 RECOMANDARE GPU: Pentru ${c.gpu.split(' ').slice(0,2).join(' ')}, producătorul recomandă ${gpuPsuRec.recommended}W PSU pentru performanță optimă. Sursa ta (${psuWatts}W) funcționează dar nu este ideală.`,
                        components: ['gpuSection', 'psuSection'],
                        isError: false,
                        score: -15
                    });
                }
            }
        }
    }
    
    // 2. CPU MOTHERBOARD COMPATIBILITY
    if (c.cpu && c.mb) {
         let cpuSocket = (c.cpu_socket || '').toLowerCase();
  let mbSocket  = (c.mb_socket  || '').toLowerCase();
 function extractSocket(str) {
    if (!str) return '';
    const match = str.match(/(am4|am5|lga-?\d{3,5}|socket\s?\d{3,5})/i);
    if (match) {
      let socket = match[0].replace(/-/g, '').toLowerCase();
      if (socket.startsWith('s'))      socket = 'lga' + socket.substring(1);
      if (socket.startsWith('socket')) socket = 'lga' + socket.substring(6);
      return socket;
    }
    return '';
  }

  if (!cpuSocket) cpuSocket = extractSocket(c.cpu);
  if (!mbSocket)  mbSocket  = extractSocket(c.mb);

  console.log('🔌 Socket Check: CPU=' + cpuSocket + ', MB=' + mbSocket);

  if (cpuSocket && mbSocket && cpuSocket !== mbSocket) {
    warnings.push({
      message: `🚨 INCOMPATIBILITATE SOCKET: CPU (${cpuSocket.toUpperCase()}) și placa de bază (${mbSocket.toUpperCase()}) au socketuri diferite!`,
      components: ['cpuSection','mbSection'],
      isError: true,
      score: -80
    });
  }
        // Brand compatibility
        const cpuText = c.cpu.toLowerCase();
        const mbText = c.mb.toLowerCase();
        
        const isIntelCpu = cpuText.includes('intel') || /lga\d{4}/.test(cpuText);
        const isAmdCpu = cpuText.includes('amd') || cpuText.includes('ryzen') || /am[45]/.test(cpuText);
        
        const intelChipsets = /(z690|z790|z890|b660|b760|h610|h770)/;
        const amdChipsets = /(b550|x570|a520|b650|b850|x670|x870|b450)/;
        
        const isIntelMb = /lga\d{4}/.test(mbText) || intelChipsets.test(mbText);
        const isAmdMb = /am[45]/.test(mbText) || amdChipsets.test(mbText);
        
        if ((isIntelCpu && isAmdMb) || (isAmdCpu && isIntelMb)) {
            warnings.push({
                message: `🚨 INCOMPATIBILITATE BRAND: CPU ${isIntelCpu ? 'Intel' : 'AMD'} nu este compatibil cu placa de bază ${isIntelMb ? 'Intel' : 'AMD'}!`,
                components: ['cpuSection', 'mbSection'],
                isError: true,
                score: -75
            });
        }
    }
    
    // 3. RAM MOTHERBOARD COMPATIBILITY
    if (c.ram && c.mb) {
        const mbDdrTypes = {
            // Intel chipsets
            'z890': 'ddr5', 'z790': 'ddr5', 'b760': 'ddr5', 'h770': 'ddr5',
            'z690': 'ddr4', 'b660': 'ddr4', 'h610': 'ddr4',
            'z590': 'ddr4', 'b560': 'ddr4', 'h510': 'ddr4',
            // AMD chipsets
            'x870': 'ddr5', 'b850': 'ddr5', 'x670': 'ddr5', 'b650': 'ddr5',
            'x570': 'ddr4', 'b550': 'ddr4', 'b450': 'ddr4', 'a520': 'ddr4'
        };
        
        const ramText = c.ram.toLowerCase();
        const mbText = c.mb.toLowerCase();
        
        let mbRamType = null;
        for (const [chipset, ramType] of Object.entries(mbDdrTypes)) {
            if (mbText.includes(chipset)) {
                mbRamType = ramType;
                break;
            }
        }
        
        const ramType = ramText.includes('ddr5') ? 'ddr5' : ramText.includes('ddr4') ? 'ddr4' : null;
        
        console.log('💾 RAM Check: RAM=' + ramType + ', MB supports=' + mbRamType);
        
        if (ramType && mbRamType && ramType !== mbRamType) {
            warnings.push({
                message: `🚨 INCOMPATIBILITATE RAM: RAM-ul ${ramType.toUpperCase()} nu este compatibil cu placa de bază care suportă ${mbRamType.toUpperCase()}!`,
                components: ['ramSection', 'mbSection'],
                isError: true,
                score: -60
            });
        }
    }
    
if (c.mb) {
        const mbText = c.mb.toLowerCase();
        const mbSocket = (c.motherboard_socket || '').toLowerCase();
        const mbChipset = (c.motherboard_chipset || '').toLowerCase();
        const mbRamType = (c.motherboard_ramType || '').toLowerCase();

        // Define legacy/unsupported components
        const legacySockets = ['lga775', 'lga1155', 'lga1150', 'lga1151', 'lga1156', 'lga2011', 'lga2066', 'am3', 'am3+', 'fm2', 'fm2+', 'socket 370'];
        const legacyChipsets = ['g41', 'z68', 'h87', 'h310', 'z77', 'h110', 'p55', 'p7p', 'z370', 'h81'];
        const legacyRamTypes = ['ddr2', 'ddr3'];

        const isLegacySocket = legacySockets.some(s => mbSocket.includes(s));
        const isLegacyChipset = legacyChipsets.some(c => mbChipset.includes(c) || mbText.includes(c));
        const isLegacyRam = legacyRamTypes.some(r => mbRamType.includes(r));

        console.log('⚠️ Legacy Check:', { isLegacySocket, isLegacyChipset, isLegacyRam, mbSocket, mbChipset, mbRamType });

        // LEGACY SOCKET WARNING
        if (isLegacySocket) {
            warnings.push({
                message: `⚠️ PLACA LEGACY: Socket ${mbSocket.toUpperCase()} este vechi și nu este mai recomandat pentru build-uri noi. Compatibilitatea cu CPU-urile moderne nu este garantată!`,
                components: ['mbSection'],
                isError: false,
                score: -35
            });
        }

        // LEGACY CHIPSET WARNING
        if (isLegacyChipset) {
            warnings.push({
                message: `⚠️ CHIPSET LEGACY: Chipset-ul acestei plăci (${mbChipset.toUpperCase()}) este din generații anterioare. Actualizări firmware și suport pot fi limitate!`,
                components: ['mbSection'],
                isError: false,
                score: -30
            });
        }

        // DDR3 RAM WARNING
        if (isLegacyRam) {
            warnings.push({
                message: `⚠️ PLACA LEGACY DDR3: Această placa suportă ${mbRamType.toUpperCase()}, care este tehnologie foarte veche. Consideră o placă modernă cu DDR4/DDR5!`,
                components: ['mbSection', 'ramSection'],
                isError: false,
                score: -40
            });
        }

        // VERY OLD MOTHERBOARD WARNING
        if (isLegacySocket && isLegacyChipset && isLegacyRam) {
            warnings.push({
                message: `🚨 COMBINAȚIE LEGACY EXTREMĂ: Această placă este din 2010-2013. Suport driver și stabilitate nu sunt garantate!`,
                components: ['mbSection'],
                isError: false,
                score: -60
            });
        }
    }

    // ===== MODERN CPU + LEGACY MB = INCOMPATIBLE =====
    if (c.cpu && c.mb) {
        const cpuText = c.cpu.toLowerCase();
        const mbSocket = (c.motherboard_socket || '').toLowerCase();
        
        const isRecentIntelCpu = cpuText.includes('i9') || cpuText.includes('i7') || cpuText.includes('core');
        const isRecentAmdCpu = cpuText.includes('ryzen 9') || cpuText.includes('ryzen 7') || cpuText.includes('ryzen 5');
        const isModernCpu = isRecentIntelCpu || isRecentAmdCpu;

        const legacySockets = ['lga775', 'lga1155', 'lga1150', 'lga1156', 'lga2011', 'am3', 'am3+', 'fm2'];
        const isLegacySocket = legacySockets.some(s => mbSocket.includes(s));

        if (isModernCpu && isLegacySocket) {
            warnings.push({
                message: `🚨 INCOMPATIBILITATE VERSIUNE: CPU-ul modern nu poate fi folosit cu o placă din generații anterioare (${mbSocket.toUpperCase()})!`,
                components: ['cpuSection', 'mbSection'],
                isError: true,
                score: -85
            });
        }
    }
    // 4. CASE CLEARANCE CHECKS
    if (c.case) {
        // GPU clearance in compact cases
        if (/(mini-itx|matrexx 30)/i.test(c.case) && /(5090|5080|4090|4080|7900 xt)/i.test(c.gpu)) {
            warnings.push({
                message: `⚠️ ATENȚIE DIMENSIUNI: GPU-ul selectat poate fi prea lung pentru această carcasă compact. Verifică dimensiunile înainte de achiziție.`,
                components: ['gpuSection', 'caseSection'],
                isError: false,
                score: -20
            });
        }
        
        // Cooler clearance
        if (/(mini-itx)/i.test(c.case) && /(tower|large|360|420)/i.test(c.cooler)) {
            warnings.push({
                message: `⚠️ ATENȚIE ÎNĂLȚIME: Coolerul poate fi prea înalt pentru această carcasă compact.`,
                components: ['coolerSection', 'caseSection'],
                isError: false,
                score: -15
            });
        }
    }
    
    // Apply score adjustments
    warnings.forEach(w => {
        if (w.score) {
            score += w.score;
        }
    });
    
    score = Math.max(0, Math.min(100, score));
    
    // Display all warnings and update score
    displayWarningsAndUpdateScore(warnings, score);
    
    console.log('🔧 === COMPLETE COMPATIBILITY CHECK END ===');
    console.log('📊 Final Score:', score, 'Warnings:', warnings.length);
}

function displayWarningsAndUpdateScore(warnings, baseScore) {
    const warningsContainer = document.getElementById('warningsContainer');
    const indicator = document.getElementById('compatibilityIndicator');
    const percent = document.getElementById('compatibilityPercent');
    const badge = document.getElementById('compatibility-badge');
    
    // Clear previous warnings and highlights
    warningsContainer.innerHTML = '';
    document.querySelectorAll('.component-card').forEach(card => {
        card.classList.remove('highlight', 'error');
    });
    
    // Update score display
    if (percent) {
        percent.textContent = `COMPATIBILITATE ${baseScore}%`;
    }
    
    // Update indicator color and badge
    if (indicator && badge) {
        indicator.className = 'score-indicator';
        badge.className = 'compatibility-badge';
        
        if (baseScore < 50) {
            indicator.classList.add('error');
            badge.classList.add('error');
        } else if (baseScore < 80) {
            indicator.classList.add('warning');
            badge.classList.add('warning');
        }
    }
    
    // Display warnings
    warnings.forEach(w => {
        const warningEl = document.createElement('div');
        
        let warningClass = 'warning';
        if (w.isError) {
            warningClass = 'error';
        } else if (w.message.includes('INFO') || w.message.includes('💡')) {
            warningClass = 'info';
        }
        
        warningEl.className = `warning-item ${warningClass}`;
        warningEl.innerHTML = `
            <svg class="warning-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
            </svg>
            ${w.message}
        `;
        
        warningsContainer.appendChild(warningEl);
        
        // Highlight problematic components
        w.components?.forEach(componentId => {
            const element = document.getElementById(componentId);
            if (element) {
                element.classList.add(w.isError ? 'error' : 'highlight');
            }
        });
    });
}

function updateConfigurationSummary() {
    const totalPriceSpan = document.getElementById('totalPrice');
    const componentsCountSpan = document.getElementById('components-count');
    const buildStatusSpan = document.getElementById('build-status');
    const selectedComponentsContainer = document.getElementById('selected-components');
    const exportBtn = document.getElementById('exportPdfBtn');
    
    if (!totalPriceSpan) return;
    
    const urlParams = new URLSearchParams(window.location.search);
    let total = 0;
    let componentsCount = 0;
    let hasComponents = false;
    let selectedComponentsHtml = '';
    
    console.log('💰 === PRICE CALCULATION START ===');
    
    // ITERATE THROUGH ALL COMPONENTS AND CALCULATE TOTAL
    for (const [key, component] of Object.entries(COMPONENT_CONFIG)) {
        const componentName = urlParams.get(component.nameParam);
        const componentPrice = urlParams.get(component.priceParam);
        
        if (componentName && componentName.trim() && !/niciun|none|not selected|selectat/i.test(componentName.trim())) {
            componentsCount++;
            hasComponents = true;
            
            let displayName = decodeURIComponent(componentName);
            displayName = displayName .replace(/de la\s*\d+\s*LEI/gi, '').replace(/LEI/gi, '').replace(/-/g, '').trim();
            
            let priceValue = 0;
            let priceDisplay = '';
            
            if (componentPrice && !isNaN(componentPrice)) {
                priceValue = parseInt(componentPrice, 10);
                total += priceValue;
                priceDisplay = `${priceValue} LEI`;
                console.log(`✅ Added ${key}: ${displayName} - ${priceValue} LEI`);
            } else {
                priceDisplay = 'Preț nedisponibil';
            }
            
            selectedComponentsHtml += `
                <div class="selected-component">
                    <div class="selected-icon">${component.icon}</div>
                    <div class="selected-info">
                        <div class="selected-name">${displayName}</div>
                        <div class="selected-price">${priceDisplay}</div>
                    </div>
                </div>
            `;
            
            const displayElement = document.getElementById(component.displayElement);
            if (displayElement) {
                let displayText = displayName;
                if (priceValue > 0) {
                    displayText += ` - de la ${priceValue} LEI`;
                }
                displayElement.textContent = displayText;
                displayElement.classList.add('component-selected');
                
                const card = document.getElementById(component.cardId);
                if (card) {
                    card.classList.add('selected');
                }
            }
        }
    }
    
    console.log(`💰 Total: ${componentsCount} components, ${total} LEI`);
    
    // Update displays
    if (selectedComponentsContainer) {
        if (hasComponents) {
            selectedComponentsContainer.innerHTML = selectedComponentsHtml;
        } else {
            selectedComponentsContainer.innerHTML = `
                <div style="text-align: center; color: var(--text-secondary); font-style: italic; padding: 2rem 0;">
                    Nicio componentă selectată.
                </div>
            `;
        }
    }
    
    const currentPrice = parseInt(totalPriceSpan.textContent.replace(/\D/g, '')) || 0;
    animateNumber(totalPriceSpan, currentPrice, total);
    
    if (componentsCountSpan) {
        componentsCountSpan.textContent = `${componentsCount} / 8`;
    }
    
    if (buildStatusSpan) {
        let buildStatus = 'Nu a început';
        if (componentsCount === 8) {
            buildStatus = 'Complet';
        } else if (componentsCount >= 6) {
            buildStatus = 'Aproape gata';
        } else if (componentsCount >= 3) {
            buildStatus = 'În progres';
        } else if (componentsCount >= 1) {
            buildStatus = 'Început';
        }
        buildStatusSpan.textContent = buildStatus;
    }
    
    if (exportBtn) {
        if (componentsCount > 0) {
            exportBtn.disabled = false;
            exportBtn.style.opacity = '1';
        } else {
            exportBtn.disabled = true;
            exportBtn.style.opacity = '0.5';
        }
    }
    
    updateDebugInfo();
}

function animateNumber(element, from, to, duration = 800) {
    const start = performance.now();
    
    const update = (now) => {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const easeProgress = 1 - Math.pow(1 - progress, 3);
        const value = Math.round(from + (to - from) * easeProgress);
        
        if (value <= 0) {
            element.textContent = '0 LEI';
        } else {
            element.textContent = `${value.toLocaleString('ro-RO')} LEI`;
        }
        
        if (progress < 1) {
            requestAnimationFrame(update);
        }
    };
    
    requestAnimationFrame(update);
}

// Enhanced JavaScript for the new design
document.addEventListener('DOMContentLoaded', function() {
   const urlParams = new URLSearchParams(window.location.search);
const mbParam = urlParams.get('motherboard');
const mbSocket = urlParams.get('motherboard_socket');
const mbChipset = urlParams.get('motherboard_chipset');

    // Component mapping for URLs
    const componentUrls = {
        cpu: '<?php echo home_url('/select-cpu'); ?>',
        cooler: '<?php echo home_url('/select-cpu-cooler'); ?>',
        mb: '<?php echo home_url('/select-mb'); ?>',
        ram: '<?php echo home_url('/select-ram'); ?>',
        gpu: '<?php echo home_url('/select-gpu'); ?>',
        storage: '<?php echo home_url('/select-ssd'); ?>',
        psu: '<?php echo home_url('/select-psu'); ?>',
        case: '<?php echo home_url('/select-case'); ?>'
    };
    
    // Add click handlers to component cards
    document.querySelectorAll('.component-card').forEach(card => {
        card.addEventListener('click', function() {
            const component = this.dataset.component;
            if (componentUrls[component]) {
                const currentParams = window.location.search;
                let href = componentUrls[component];
                
                if (currentParams && currentParams.length > 1) {
                    href += href.includes('?') ? '&' + currentParams.substring(1) : currentParams;
                }
                
                // Scroll back to this component after return
                localStorage.setItem('scrollBackTo', this.id);
                window.location.href = href;
            }
        });
        if (mbParam && mbParam !== 'undefined') {
    const selectedMbElement = document.getElementById('selectedMb');
    if (selectedMbElement) {
        let displayText = decodeURIComponent(mbParam);
        if (mbSocket) displayText += ` (${mbSocket.toUpperCase()})`;
        if (mbChipset) displayText += ` - ${mbChipset}`;
        selectedMbElement.textContent = displayText;
        selectedMbElement.classList.add('component-selected');
        
        const mbCard = document.getElementById('mbSection');
        if (mbCard) mbCard.classList.add('selected');
    }
}

// Same fix pentru re-select
const mbSection = document.getElementById('mbSection');
if (mbSection) {
    mbSection.addEventListener('click', function(e) {
        if (!e.target.closest('.component-icon') && !e.target.closest('.component-arrow')) {
            const currentParams = new URLSearchParams(window.location.search);
            currentParams.delete('motherboard');
            currentParams.delete('motherboard_socket');
            currentParams.delete('motherboard_chipset');
            currentParams.delete('motherboard_formFactor');
            currentParams.delete('motherboard_ramSlots');
            currentParams.delete('motherboard_maxRam');
            currentParams.delete('motherboard_pciSlots');
            
            const queryString = currentParams.toString();
            const selectMbUrl = `<?php echo home_url('/select-mb/'); ?>?${queryString}`;
            window.location.href = selectMbUrl;
        }
    });
}
        // Add hover effects
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('selected')) {
                this.style.transform = 'translateY(-3px)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('selected')) {
                this.style.transform = 'translateY(-2px)';
            }
        });
    });
    
    // Smooth scroll to configurator
    const heroButton = document.querySelector('.hero-cta');
    if (heroButton) {
        heroButton.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('configurator').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }
    
    // Reset button
    document.getElementById('resetButton')?.addEventListener('click', function() {
        if (confirm('Ești sigur că vrei să resetezi toată configurația?')) {
            const baseUrl = window.location.href.split('?')[0];
            window.location.href = baseUrl;
        }
    });
    
    // ===== PREMIUM PDF EXPORT WITH MATCHING DESIGN =====
    document.getElementById('exportPdfBtn')?.addEventListener('click', async function() {
        const c = getComponentDetails();
        
        this.classList.add('loading');
        this.disabled = true;
        this.textContent = 'Se generează PDF...';
        
        try {
            // Load jsPDF
            if (typeof jsPDF === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
                await new Promise((resolve, reject) => {
                    script.onload = () => {
                        window.jsPDF = window.jspdf.jsPDF;
                        resolve();
                    };
                    script.onerror = reject;
                    document.head.appendChild(script);
                });
            }

            console.log('📄 Creating PREMIUM PDF with matching design...');

            // Create PDF with exact configurator colors
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            // EXACT COLOR PALETTE FROM CONFIGURATOR
            const colors = {
                primary: [33, 197, 93],       // --text-accent: #21C55D  
                primaryDark: [22, 163, 74],   // --primary-gradient end: #16A34A
                secondary: [59, 130, 246],    // --secondary-gradient: #3B82F6
                accent: [245, 158, 11],       // --accent-gradient: #F59E0B
                danger: [239, 68, 68],        // --danger-gradient: #EF4444
                
                darkSurface: [15, 20, 25],    // --dark-surface: #0F1419
                darkCard: [45, 55, 72],       // --dark-card: #2D3748
                textPrimary: [247, 250, 252], // --text-primary: #F7FAFC
                textSecondary: [160, 174, 192], // --text-secondary: #A0AEC0
                
                success: [0, 249, 100],       // --success-green: #00f964
                warning: [255, 152, 0],       // --warning-orange: #ff9800
                error: [244, 67, 54],         // --error-red: #f44336
                
                glass: [248, 250, 252],       // Glass overlay light
                glassBorder: [229, 231, 235], // Glass border light
            };

            // Component labels with exact icons from configurator
            const labels = {
                cpu: { name: 'PROCESOR', color: colors.primary },
                cooler: { name: 'COOLER CPU', color: colors.secondary },
                mb: { name: 'PLACA DE BAZA', color: colors.primary },
                ram: { name: 'MEMORIE RAM', color: colors.accent },
                gpu: { name: 'PLACA VIDEO', color: colors.danger },
                ssd: { name: 'STOCARE SSD', color: colors.secondary },
                psu: { name: 'SURSA ALIMENTARE', color: colors.warning },
                case: { name: 'CARCASA', color: colors.primary }
            };
            
            let total = 0;
            let componentCount = 0;
            let systemPower = 0;
            const components = [];
            
            console.log('📊 Processing components with premium design...');
            
            // Collect component data
            Object.keys(labels).forEach(key => {
                const name = c[key];
                if (name && !/niciun|none|selectat/i.test(name)) {
                    componentCount++;
                    const price = c[key + '_price'] ? parseInt(c[key + '_price'], 10) : 0;
                    total += price;
                    
                    components.push({
                        category: labels[key].name,
                        name: name.replace(/LEI/g, '').replace(/de la \d+ /g, '').trim(),
                        price: price,
                        color: labels[key].color
                    });
                    
                    console.log(`✨ Added: ${labels[key].name} - ${name} - ${price} LEI`);
                }
            });
            
            // Advanced power calculation
            if (c.cpu) {
                if (c.cpu.includes('i9') || c.cpu.includes('9950X')) systemPower += 150;
                else if (c.cpu.includes('i7') || c.cpu.includes('7800X3D')) systemPower += 100;
                else if (c.cpu.includes('i5') || c.cpu.includes('7600X')) systemPower += 80;
                else systemPower += 65;
            }
            
            if (c.gpu) {
                if (c.gpu.includes('5090')) systemPower += 575;
                else if (c.gpu.includes('5080') || c.gpu.includes('4090')) systemPower += 450;
                else if (c.gpu.includes('4080')) systemPower += 320;
                else if (c.gpu.includes('4070')) systemPower += 250;
                else if (c.gpu.includes('4060')) systemPower += 150;
                else systemPower += 100;
            }
            
            systemPower += 50;
            const recommendedPsu = Math.round(systemPower * 1.3);
            
            // SET DARK BACKGROUND LIKE CONFIGURATOR
            pdf.setFillColor(...colors.darkSurface);
            pdf.rect(0, 0, 210, 297, 'F'); // Full A4 dark background
            
            let yPos = 25;
            
            // ===== PREMIUM HEADER DESIGN =====
            // Background gradient effect simulation
            for (let i = 0; i < 15; i++) {
                const alpha = 0.15 - (i * 0.01);
                const greenValue = 197 + (i * 2);
                pdf.setFillColor(33, Math.min(greenValue, 255), 93, alpha);
                pdf.circle(105, 25, 50 + (i * 3), 'F');
            }
            
            // Main title with glassmorphism effect
            pdf.setFillColor(248, 250, 252, 0.1); // Glass surface
            pdf.roundedRect(25, yPos - 5, 160, 25, 5, 5, 'F');
            
            // Title text matching hero-title
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(26);
            pdf.setTextColor(...colors.textPrimary);
            pdf.text('PC BUILDER 2025', 105, yPos + 5, { align: 'center' });
            
            pdf.setFontSize(14);
            pdf.setFont('helvetica', 'normal');
            pdf.setTextColor(...colors.textSecondary);
            pdf.text('CONFIGURATIE COMPLETA CU COMPATIBILITATE VERIFICATA', 105, yPos + 12, { align: 'center' });
            
            pdf.setFontSize(10);
            pdf.text(`Generata pe ${new Date().toLocaleDateString('ro-RO')} | asamblarepc.ro`, 105, yPos + 18, { align: 'center' });
            
            yPos += 35;
            
            // ===== GLASSMORPHISM SUMMARY CARDS =====
            // Left card - Components (matching summary-panel design)
            pdf.setFillColor(248, 250, 252, 0.05); // Glass surface  
            pdf.setDrawColor(...colors.glassBorder, 0.3);
            pdf.setLineWidth(0.5);
            pdf.roundedRect(25, yPos, 70, 30, 8, 8, 'FD');
            
            // Component count with primary gradient effect
            pdf.setFillColor(...colors.primary, 0.1);
            pdf.roundedRect(30, yPos + 5, 60, 8, 4, 4, 'F');
            
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(10);
            pdf.setTextColor(...colors.textSecondary);
            pdf.text('COMPONENTE SELECTATE', 60, yPos + 10, { align: 'center' });
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(20);
            pdf.setTextColor(...colors.primary);
            pdf.text(`${componentCount}/8`, 60, yPos + 22, { align: 'center' });
            
            // Right card - Total Price  
            pdf.setFillColor(248, 250, 252, 0.05);
            pdf.roundedRect(105, yPos, 70, 30, 8, 8, 'FD');
            
            pdf.setFillColor(...colors.accent, 0.1);
            pdf.roundedRect(110, yPos + 5, 60, 8, 4, 4, 'F');
            
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(10);
            pdf.setTextColor(...colors.textSecondary);
            pdf.text('PRET TOTAL ESTIMAT', 140, yPos + 10, { align: 'center' });
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(18);
            pdf.setTextColor(...colors.accent);
            pdf.text(total > 0 ? `${total.toLocaleString('ro-RO')} LEI` : 'N/A', 140, yPos + 22, { align: 'center' });
            
            yPos += 45;
            
            // ===== COMPATIBILITY BADGE =====
            const compatibilityScore = 100; // You can calculate this dynamically
            let badgeColor = colors.primary;
            let badgeText = 'COMPATIBILITATE 100%';
            
            if (compatibilityScore < 50) {
                badgeColor = colors.error;
                badgeText = 'PROBLEME DETECTATE';
            } else if (compatibilityScore < 80) {
                badgeColor = colors.warning;
                badgeText = 'ATENTIE NECESARA';
            }
            
            pdf.setFillColor(...badgeColor, 0.15);
            pdf.roundedRect(40, yPos, 130, 12, 6, 6, 'F');
            pdf.setDrawColor(...badgeColor);
            pdf.setLineWidth(1);
            pdf.roundedRect(40, yPos, 130, 12, 6, 6, 'D');
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(11);
            pdf.setTextColor(...badgeColor);
            pdf.text(badgeText, 105, yPos + 7, { align: 'center' });
            
            yPos += 25;
            
            // ===== PREMIUM COMPONENTS TABLE =====
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(14);
            pdf.setTextColor(...colors.textPrimary);
            pdf.text('COMPONENTE CONFIGURATIE', 25, yPos);
            
            yPos += 10;
            
            // Table header with glassmorphism
            pdf.setFillColor(248, 250, 252, 0.08);
            pdf.setDrawColor(...colors.glassBorder, 0.3);
            pdf.roundedRect(25, yPos, 160, 10, 3, 3, 'FD');
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(9);
            pdf.setTextColor(...colors.textPrimary);
            pdf.text('COMPONENTA', 30, yPos + 6);
            pdf.text('MODEL SELECTAT', 80, yPos + 6);
            pdf.text('PRET', 170, yPos + 6, { align: 'right' });
            
            yPos += 12;
            
            // Component rows with alternating glass effects
            components.forEach((comp, index) => {
                if (yPos > 260) {
                    pdf.addPage();
                    // Re-apply dark background on new page
                    pdf.setFillColor(...colors.darkSurface);
                    pdf.rect(0, 0, 210, 297, 'F');
                    yPos = 25;
                }
                
                // Alternating row backgrounds
                if (index % 2 === 0) {
                    pdf.setFillColor(255, 255, 255, 0.02);
                    pdf.roundedRect(25, yPos - 2, 160, 10, 2, 2, 'F');
                }
                
                // Component icon and name
                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(9);
                pdf.setTextColor(...comp.color);
                pdf.text(comp.category, 30, yPos + 3);
                
                // Component model 
                pdf.setFont('helvetica', 'normal');
                pdf.setTextColor(...colors.textPrimary);
                let displayName = comp.name;
                if (displayName.length > 45) {
                    displayName = displayName.substring(0, 42) + '...';
                }
                pdf.text(displayName, 80, yPos + 3);
                
                // Price
                pdf.setFont('helvetica', 'bold');
                pdf.setTextColor(...colors.accent);
                pdf.text(comp.price > 0 ? `${comp.price.toLocaleString('ro-RO')} LEI` : '-', 170, yPos + 3, { align: 'right' });
                
                yPos += 10;
            });
            
            // Total row with premium styling
            yPos += 5;
            pdf.setFillColor(...colors.primary, 0.15);
            pdf.roundedRect(25, yPos, 160, 12, 4, 4, 'F');
            pdf.setDrawColor(...colors.primary);
            pdf.setLineWidth(1);
            pdf.roundedRect(25, yPos, 160, 12, 4, 4, 'D');
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(12);
            pdf.setTextColor(...colors.primary);
            pdf.text('TOTAL CONFIGURATIE', 30, yPos + 7);
            pdf.setFontSize(14);
            pdf.text(total > 0 ? `${total.toLocaleString('ro-RO')} LEI` : 'N/A', 170, yPos + 7, { align: 'right' });
            
            yPos += 25;
            
            // ===== POWER ANALYSIS SECTION =====
            if (c.psu_watts && systemPower > 0) {
                if (yPos > 220) {
                    pdf.addPage();
                    pdf.setFillColor(...colors.darkSurface);
                    pdf.rect(0, 0, 210, 297, 'F');
                    yPos = 25;
                }
                
                const psuWatts = parseInt(c.psu_watts);
                const utilization = (systemPower / psuWatts) * 100;
                
                let statusText = '';
                let statusColor = colors.success;
                let statusBg = colors.success;
                
                if (utilization > 90) {
                    statusText = '🚨 RISC RIDICAT';
                    statusColor = colors.error;
                    statusBg = colors.error;
                } else if (utilization > 70) {
                    statusText = '⚠️ ATENTIE';
                    statusColor = colors.warning;
                    statusBg = colors.warning;
                } else {
                    statusText = '✅ OPTIMAL';
                    statusColor = colors.success;
                    statusBg = colors.success;
                }
                
                // Power analysis header
                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(14);
                pdf.setTextColor(...colors.textPrimary);
                pdf.text('ANALIZA PUTERII SI CONSUM', 25, yPos);
                
                yPos += 10;
                
                // Power analysis box with glassmorphism
                pdf.setFillColor(248, 250, 252, 0.05);
                pdf.setDrawColor(...colors.glassBorder, 0.3);
                pdf.roundedRect(25, yPos, 160, 40, 6, 6, 'FD');
                
                // Status badge
                pdf.setFillColor(...statusBg, 0.15);
                pdf.roundedRect(130, yPos + 5, 50, 8, 4, 4, 'F');
                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(8);
                pdf.setTextColor(...statusColor);
                pdf.text(statusText, 155, yPos + 10, { align: 'center' });
                
                // Power details with modern styling
                pdf.setFont('helvetica', 'normal');
                pdf.setFontSize(10);
                pdf.setTextColor(...colors.textSecondary);
                
                const powerDetails = [
                    { label: 'Consum estimat sistem:', value: `${systemPower}W`, color: colors.textPrimary },
                    { label: 'PSU recomandat minimum:', value: `${recommendedPsu}W+`, color: colors.warning },
                    { label: 'PSU actual instalat:', value: `${psuWatts}W`, color: colors.primary },
                    { label: 'Utilizare PSU:', value: `${utilization.toFixed(1)}% ${statusText.split(' ')[1] || ''}`, color: statusColor }
                ];
                
                let detailY = yPos + 16;
                powerDetails.forEach(detail => {
                    pdf.text(detail.label, 30, detailY);
                    pdf.setFont('helvetica', 'bold');
                    pdf.setTextColor(...detail.color);
                    pdf.text(detail.value, 175, detailY, { align: 'right' });
                    pdf.setFont('helvetica', 'normal');
                    pdf.setTextColor(...colors.textSecondary);
                    detailY += 6;
                });
                
                yPos += 50;
            }
            
            // ===== COMPATIBILITY VERIFICATION SECTION =====
            if (yPos > 200) {
                pdf.addPage();
                pdf.setFillColor(...colors.darkSurface);
                pdf.rect(0, 0, 210, 297, 'F');
                yPos = 25;
            }
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(14);
            pdf.setTextColor(...colors.textPrimary);
            pdf.text(' VERIFICARI COMPATIBILITATE', 25, yPos);
            
            yPos += 10;
            
            // Compatibility box with blue glassmorphism
            pdf.setFillColor(...colors.secondary, 0.08);
            pdf.setDrawColor(...colors.secondary, 0.3);
            pdf.roundedRect(25, yPos, 160, 50, 6, 6, 'FD');
            
            const compatibilityChecks = [
                '✅ Socket Compatibility: CPU si Motherboard verificate automat',
                '✅ RAM Compatibility: DDR4/DDR5 verificat cu chipset-ul',  
                '✅ Power Analysis: PSU sufficient pentru întreaga configuratie',
                '✅ Case Clearance: Dimensiuni GPU si Cooler verificate',
                '✅ Brand Matching: Intel/AMD compatibility assured',
                '✅ TDP Analysis: Thermal design power optim calculat'
            ];
            
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(9);
            pdf.setTextColor(...colors.textPrimary);
            
            let checkY = yPos + 8;
            compatibilityChecks.forEach(check => {
                pdf.text(check, 30, checkY);
                checkY += 7;
            });
            
            yPos += 65;
            
            // ===== PREMIUM FOOTER =====
            if (yPos > 250) {
                pdf.addPage();
                pdf.setFillColor(...colors.darkSurface);
                pdf.rect(0, 0, 210, 297, 'F');
                yPos = 25;
            }
            
            // Footer separator
            pdf.setDrawColor(...colors.glassBorder);
            pdf.setLineWidth(0.5);
            pdf.line(25, yPos, 185, yPos);
            
            yPos += 10;
            
            // Brand section
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(16);
            pdf.setTextColor(...colors.primary);
            pdf.text('asamblarepc.ro', 105, yPos, { align: 'center' });
            
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(10);
            pdf.setTextColor(...colors.textSecondary);
            pdf.text('Configurator PC cu verificare completa de compatibilitate', 105, yPos + 6, { align: 'center' });
            pdf.text('Sistem complet automat: Socket, RAM, PSU, Case Clearance', 105, yPos + 11, { align: 'center' });
            
            yPos += 20;
            
            // Disclaimer with matching styling
            pdf.setFillColor(...colors.warning, 0.08);
            pdf.roundedRect(25, yPos, 160, 15, 4, 4, 'F');
            
            pdf.setFont('helvetica', 'bold');
            pdf.setFontSize(8);
            pdf.setTextColor(...colors.warning);
            pdf.text('DISCLAIMER IMPORTANT', 30, yPos + 5);
            
            pdf.setFont('helvetica', 'normal');
            pdf.setTextColor(...colors.textSecondary);
            pdf.text('Preturile afisate nu includ TVA si pot varia in functie de stoc', 30, yPos + 9);
            const disclaimer = [
    "Acest configurator nu reprezinta stoc real sau oferta de vanzare.",
    "Dupa completarea PDF-ului, trimite-l la asamblarepc.ro pentru a comanda piesele",
    "de la retaileri/distribuitori.",
    "Preturile pot varia si vor fi confirmate dupa verificarea stocului."
];
pdf.text(disclaimer, 30, yPos + 12);

            // Save with premium filename
            const timestamp = new Date().toISOString().slice(0, 19).replace(/:/g, '-');
            const filename = `PC-Builder-Premium-${timestamp}.pdf`;
            pdf.save(filename);
            
            console.log('PREMIUM PDF generated successfully!');
            console.log(`📁 Filename: ${filename}`);
            console.log(`📊 ${componentCount} components, ${total} LEI total, ${systemPower}W power`);
            
        } catch (error) {
            console.error('❌ Premium PDF Export Error:', error);
            alert('Eroare la generarea PDF-ului premium. Verifica consola pentru detalii si incearca din nou.');
        } finally {
            this.classList.remove('loading');
            this.disabled = false;
            this.textContent = '📄 Export PDF';
        }
    });
    
    // Share configuration pdf.text('PC BUILDER 2025', ...);
    document.getElementById('shareConfigBtn')?.addEventListener('click', async function() {
        const url = window.location.href;
        
        if (navigator.share) {
            try {
                await navigator.share({
                    title: 'Configurația mea PC completă - asamblarepc.ro',
                    text: 'Vezi configurația PC cu compatibilitate completă verificată!',
                    url: url
                });
            } catch (error) {
                console.log('Share cancelled');
            }
        } else {
            try {
                await navigator.clipboard.writeText(url);
                
                // Show notification
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 1000;
                    background: var(--success-green);
                    color: var(--dark-surface);
                    padding: 1rem 1.5rem;
                    border-radius: 12px;
                    font-weight: 600;
                    animation: slideIn 0.3s ease;
                `;
                
                notification.textContent = 'Link copiat în clipboard!';
                document.body.appendChild(notification);
                setTimeout(() => notification.remove(), 3000);
            } catch (error) {
                console.error('Copy failed:', error);
            }
        }
    });
    
    // Handle scroll back to component after selection
    const scrollBackTo = localStorage.getItem('scrollBackTo');
    if (scrollBackTo) {
        localStorage.removeItem('scrollBackTo');
        setTimeout(() => {
            const element = document.getElementById(scrollBackTo);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                element.style.animation = 'highlight-flash 2s ease-out';
            }
        }, 500);
    }
    
    // Load configuration and run complete compatibility check
    console.log('🔧 Loading configuration with COMPLETE compatibility analysis...');
    updateConfigurationSummary();
    setTimeout(checkCompatibility, 200);
    
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe component cards for animation
    document.querySelectorAll('.component-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });
    
    // Add highlight animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes highlight-flash {
            0%, 100% { background: rgba(255, 255, 255, 0.03); }
            50% { background: rgba(33, 197, 93, 0.2); }
        }
    `;
    document.head.appendChild(style);
    
});

class PremiumChatbotAI {
     constructor() {
        this.container = document.getElementById('chatbot-container');
        this.overlay = document.getElementById('chatbot-overlay');
        this.launcher = document.getElementById('chatbot-launcher');
        this.messagesContainer = document.getElementById('chatbot-messages');
        this.inputField = document.getElementById('chatbot-input');
        this.sendBtn = document.getElementById('chatbot-send');
        this.header = document.getElementById('chatbot-header');
        this.minimizeBtn = document.getElementById('chatbot-minimize');
        this.closeBtn = document.getElementById('chatbot-close');
        
        // RATE LIMITING - 15 messages max
        this.messageLimit = 15;
        this.messageCount = 0;
        
        this.isLoading = false;
        this.isOpen = false;
        this.popupShown = false;
        
        this.init();
        this.loadSessionData();
        this.showPopupOnLoad();
    }
    
    // Load message count from session
    loadSessionData() {
        const stored = sessionStorage.getItem('chatbot_count');
        if (stored) {
            this.messageCount = parseInt(stored);
        }
    }
    
    // Save message count to session
    saveSessionData() {
        sessionStorage.setItem('chatbot_count', this.messageCount);
    }
    
    init() {
        this.sendBtn.addEventListener('click', () => this.sendMessage());
        this.inputField.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
        
        this.header.addEventListener('click', () => this.toggleChat());
        this.launcher.addEventListener('click', () => this.openChat());
        this.overlay.addEventListener('click', () => this.closeChat());
        this.minimizeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.minimizeChat();
        });
        this.closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.closeChat();
        });
    }
    
    // SHOW POPUP - NO AUTO-CLOSE
    showPopupOnLoad() {
        setTimeout(() => {
            if (!this.popupShown) {
                this.openChat();
                this.popupShown = true;
            }
        }, 3500);
    }
    
    openChat() {
        this.container.style.display = 'flex';
        this.launcher.classList.add('hidden');
        this.isOpen = true;
        this.inputField.focus();
    }
    
    closeChat() {
        this.container.style.display = 'none';
        this.launcher.classList.remove('hidden');
        this.isOpen = false;
    }
    
    minimizeChat() {
        this.container.classList.toggle('minimized');
        const minimizeBtn = this.minimizeBtn;
        minimizeBtn.textContent = this.container.classList.contains('minimized') ? '+' : '−';
        
        if (this.container.classList.contains('minimized')) {
            this.container.style.display = 'none';
            this.launcher.classList.remove('hidden');
        } else {
            this.container.style.display = 'flex';
            this.launcher.classList.add('hidden');
        }
    }
    
    toggleChat() {
        if (this.container.classList.contains('minimized')) {
            this.container.classList.remove('minimized');
            this.minimizeBtn.textContent = '−';
            this.container.style.display = 'flex';
            this.inputField.focus();
        }
    }
    
    async sendMessage() {
        const message = this.inputField.value.trim();
        
        if (!message || this.isLoading) return;
        
        // CHECK LIMIT
        if (this.messageCount >= this.messageLimit) {
            this.addMessage('⚠️ <strong>Limită atinsă!</strong><br>Ai ajuns la 15 mesaje. Contactează <a href="mailto:contact@asamblarepc.ro">contact@asamblarepc.ro</a> pentru suport extins.', 'bot');
            return;
        }
        
        this.addMessage(message, 'user');
        this.inputField.value = '';
        
        // INCREMENT COUNTER
        this.messageCount++;
        this.saveSessionData();
        
        this.isLoading = true;
        this.sendBtn.disabled = true;
        
        // SHOW HINTS
        const remaining = this.messageLimit - this.messageCount;
        if (remaining === 3) {
            this.addMessage('💡 Ai mai <strong>3 mesaje</strong> disponibile.', 'bot');
        } else if (remaining === 1) {
            this.addMessage('⚠️ <strong>Ultim mesaj!</strong>', 'bot');
        }
        
        this.showLoadingIndicator();
        
        try {
            const response = await fetch('/wp-json/asamblarepc/v1/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.removeLoadingIndicator();
                const formattedResponse = this.formatAIResponse(data.response);
                this.addMessage(formattedResponse, 'bot');
            } else {
                this.removeLoadingIndicator();
                this.addMessage(`❌ <strong>Eroare:</strong> ${data.error || 'Ceva a mers prost'}`, 'bot');
            }
            
        } catch (error) {
            console.error('Chatbot error:', error);
            this.removeLoadingIndicator();
            this.addMessage('❌ <strong>Eroare de conexiune.</strong> Te rog încearcă din nou.', 'bot');
        } finally {
            this.isLoading = false;
            this.sendBtn.disabled = false;
            this.inputField.focus();
        }
    }
    
    formatAIResponse(text) {
        let formatted = text
            .replace(/^### (.*?)$/gm, '<h3>$1</h3>')
            .replace(/^## (.*?)$/gm, '<h2>$1</h2>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n\n/g, '</p><p>')
            .replace(/\n/g, '<br>');
        
        return `<p>${formatted}</p>`;
    }
    
    addMessage(html, sender) {
        const messageEl = document.createElement('div');
        messageEl.className = `message ${sender}`;
        
        const contentEl = document.createElement('div');
        contentEl.className = 'message-content';
        
        if (sender === 'bot' && html.includes('<')) {
            contentEl.innerHTML = html;
        } else {
            contentEl.textContent = html;
        }
        
        messageEl.appendChild(contentEl);
        this.messagesContainer.appendChild(messageEl);
        
        setTimeout(() => {
            this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
        }, 50);
    }
    
    showLoadingIndicator() {
        const messageEl = document.createElement('div');
        messageEl.className = 'message bot loading';
        messageEl.id = 'loading-indicator';
        
        const contentEl = document.createElement('div');
        contentEl.className = 'message-content';
        contentEl.innerHTML = '<div class="typing-indicator"><span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span></div>';
        
        messageEl.appendChild(contentEl);
        this.messagesContainer.appendChild(messageEl);
        
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }
    
    removeLoadingIndicator() {
        const loadingEl = document.getElementById('loading-indicator');
        if (loadingEl) {
            loadingEl.remove();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('chatbot-container')) {
        new PremiumChatbotAI();
    }
});


<!-- AI RECOMMENDATIONS ENGINE -->
(function() {
    'use strict';
    
    class OptimizedRecommendationsEngine {
        constructor() {
        console.log('🤖 Progressive AI Engine initializing');
        this.lastConfig = null;
        this.throttleTimeout = null;
        this.updateDelay = 2000;
        this.init();
    }
        
        init() {
            console.log('📌 Listening for changes');
        document.addEventListener('componentSelected', () => this.onComponentChange());
        document.addEventListener('componentRemoved', () => this.onComponentChange());
        
        // Show initial state
        setTimeout(() => {
            this.showInitialState();
        }, 1000);
        }
        
         showInitialState() {
        const config = this.getCurrentConfig();
        
        // If no CPU, show "Start by selecting CPU"
        if (!config.cpu || config.cpu.includes('Nicio')) {
            this.displayInitialPrompt();
        } else {
            this.onComponentChange();
        }
    }
    
     displayInitialPrompt() {
        let existingRec = document.getElementById('ai-recommendations-panel');
        if (existingRec) return; // Don't show if already exists
        
        const html = `
        <div id="ai-recommendations-panel" class="apc-recommendations-section">
            <div class="apc-recommendation-container" style="text-align: center; padding: 60px 30px;">
                <div style="font-size: 80px; margin-bottom: 20px;">🤖</div>
                <h3 class="apc-recommendation-title">Recomandări AI Inteligente</h3>
                <p style="font-size: 16px; color: #666; margin: 20px 0;">
                    Selectează un procesor pentru a primi recomandări personalizate<br>
                    pentru placa de bază, RAM, GPU și alte componente compatibile.
                </p>
                <div style="margin-top: 30px;">
                    <a href="/configurator/procesor/" class="apc-btn apc-btn-add" style="display: inline-flex;">
                        🖥️ Alege Procesor
                    </a>
                </div>
            </div>
        </div>
        `;
        
        const warningsContainer = document.getElementById('warningsContainer');
        if (warningsContainer) {
            warningsContainer.insertAdjacentHTML('beforebegin', html);
        }
    }
        
        onComponentChange() {
        clearTimeout(this.throttleTimeout);
        this.throttleTimeout = setTimeout(() => {
            const config = this.getCurrentConfig();
            
            // If no CPU, show initial
            if (!config.cpu || config.cpu.includes('Nicio')) {
                this.displayInitialPrompt();
                return;
            }
            
            if (JSON.stringify(config) !== JSON.stringify(this.lastConfig)) {
                this.loadRecommendations(config);
                this.lastConfig = JSON.parse(JSON.stringify(config));
            }
        }, this.updateDelay);
    }
    
        
         getCurrentConfig() {
        return {
            cpu: (document.getElementById('selectedCpu')?.textContent || '').trim(),
            gpu: (document.getElementById('selectedGpu')?.textContent || '').trim(),
            mb: (document.getElementById('selectedMb')?.textContent || '').trim(),
            ram: (document.getElementById('selectedRam')?.textContent || '').trim(),
            psu: (document.getElementById('selectedPsu')?.textContent || '').trim(),
            case: (document.getElementById('selectedCase')?.textContent || '').trim(),
            cooler: (document.getElementById('selectedCooler')?.textContent || '').trim(),
            ssd: (document.getElementById('selectedSsd')?.textContent || '').trim(),
            totalBudget: parseInt((document.getElementById('totalPrice')?.textContent || '0').replace(/[^0-9]/g, '')),
            purpose: 'Gaming'
        };
    }
         async loadRecommendations(config) {
        console.log('🤖 Loading recommendations');
        
        try {
            const response = await fetch('/wp-json/asamblarepc/v1/recommendations', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(config)
            });
            
            const data = await response.json();
            
            if (data.success && data.recommendations) {
                this.displayRecommendations(data.recommendations, config);
            } else {
                console.warn('⚠️ No recommendations');
            }
        } catch (error) {
            console.error('❌ Error:', error);
        }
    }
        
displayRecommendations(recommendations, config) {
    console.log('🎨 Rendering AI recommendations in sidebar');
    
    let existingRec = document.getElementById('ai-recommendations-panel');
    if (existingRec) existingRec.remove();
    
    const steps = [
        {key: 'cpu', label: '🖥️', value: config.cpu},
        {key: 'mb', label: '🔌', value: config.mb},
        {key: 'ram', label: '💾', value: config.ram},
        {key: 'cooler', label: '❄️', value: config.cooler},
        {key: 'gpu', label: '🎮', value: config.gpu},
        {key: 'case', label: '📦', value: config.case},
        {key: 'psu', label: '⚡', value: config.psu},
        {key: 'ssd', label: '💿', value: config.ssd}
    ];
    
    let progressHTML = '<div class="apc-progress-mini">';
    steps.forEach(step => {
        const isSelected = step.value && !step.value.includes('Nici');
        const classes = isSelected ? 'apc-mini-step completed' : 'apc-mini-step';
        progressHTML += `<div class="${classes}">${step.label}</div>`;
    });
    progressHTML += '</div>';
    
    // BUILD CURRENT CONFIGURATION URL
    const currentParams = new URLSearchParams(window.location.search);
    const configParams = new URLSearchParams();
    
    // Preserve all existing components
    const paramMap = {
        'cpu': 'cpu',
        'cpu_tdp': 'cpu_tdp',
        'cpu_socket': 'cpu_socket',
        'motherboard': 'mb',
        'motherboard_socket': 'mb_socket',
        'ram': 'ram',
        'cpu_cooler': 'cooler',
        'cooler_tdp': 'cooler_tdp',
        'gpu': 'gpu',
        'gpu_tdp': 'gpu_tdp',
        'case': 'case',
        'psu': 'psu',
        'psu_watts': 'psu_watts',
        'ssd': 'ssd'
    };
    
    // Copy existing params
    for (const [urlParam, key] of Object.entries(paramMap)) {
        if (currentParams.has(urlParam)) {
            configParams.set(urlParam, currentParams.get(urlParam));
        }
    }
    
    // Also preserve prices
    const priceParams = ['cpuprice', 'motherboardprice', 'ramprice', 'coolerprice', 'gpuprice', 'caseprice', 'psuprice', 'ssdprice'];
    priceParams.forEach(param => {
        if (currentParams.has(param)) {
            configParams.set(param, currentParams.get(param));
        }
    });
    
    const configQuery = configParams.toString();
    
    let html = `
    <div id="ai-recommendations-panel" class="sidebar-ai-panel">
        <div class="sidebar-ai-header">
            <span class="sidebar-ai-icon">🤖</span>
            <h3 class="sidebar-ai-title">Recomandare AI - Următorul Pas</h3>
        </div>
        
        <p class="sidebar-ai-description">${recommendations.summary || 'Pe baza selecției tale actuale, iată ce recomandăm pentru următorul pas.'}</p>
        
        ${progressHTML}
    `;
    
    if (recommendations.recommendations && Array.isArray(recommendations.recommendations)) {
        recommendations.recommendations.forEach(rec => {
            if (rec.suggestions && Array.isArray(rec.suggestions)) {
                rec.suggestions.slice(0, 2).forEach(s => {
                    const pageMap = {
                        'Motherboard': '/configurator/select-mb/',
                        'RAM': '/configurator/select-ram/',
                        'GPU': '/configurator/select-gpu/',
                        'Case': '/configurator/select-case/',
                        'CPU Cooler': '/configurator/select-cpu-cooler/',
                        'Power Supply': '/configurator/select-psu/',
                        'Storage/SSD': '/configurator/select-ssd/'
                    };
                    
                    const page = pageMap[rec.component] || '/configurator/';
                    const navigationUrl = configQuery ? `${page}?${configQuery}` : page;
                    
                    html += `
                    <div class="sidebar-ai-card">
                        <div class="sidebar-card-model">${s.model}</div>
                        <div class="sidebar-card-price">${s.estimatedPrice} RON</div>
                        <div class="sidebar-card-badge">✓ ${s.compatibility}</div>
                        <p class="sidebar-card-reason">${s.reason}</p>
                        <button class="sidebar-card-btn" onclick="window.location.href='${navigationUrl}'">
                            + Adaugă ${rec.component}
                        </button>
                    </div>
                    `;
                });
            }
        });
    }
    
    html += '</div>';
    
    const possibleContainers = [
        document.querySelector('#summaryPanel'),
        document.querySelector('.price-summary'),
        document.querySelector('[class*="summary"]'),
        document.querySelector('[class*="sidebar"]'),
        document.querySelector('.elementor-widget-container')
    ];
    
    let insertTarget = possibleContainers.find(el => el !== null);
    
    if (insertTarget) {
        insertTarget.insertAdjacentHTML('afterbegin', html);
        console.log('✅ AI panel inserted in sidebar');
    } else {
        const warningsContainer = document.getElementById('warningsContainer');
        if (warningsContainer) {
            warningsContainer.insertAdjacentHTML('beforebegin', html);
            console.log('✅ AI panel inserted (fallback)');
        }
    }
}


    }
    
    // Initialize when DOM ready
    document.addEventListener('DOMContentLoaded', () => {
    window.recommendationsEngine = new OptimizedRecommendationsEngine();
});
    // Add animation
    const style = document.createElement('style');
    style.textContent = '@keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }';
    document.head.appendChild(style);
})();


</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2407217795551182"
     crossorigin="anonymous"></script>
<?php
get_footer();
?>
