import MarkdownIt from 'markdown-it';

// Configure markdown-it with Vue-friendly settings
const md = new MarkdownIt({
    // Enable HTML tags in source
    html: true,
    
    // Use '/' to close single tags (<br />)
    xhtmlOut: false,
    
    // Convert '\n' in paragraphs into <br>
    breaks: true,
    
    // CSS language prefix for fenced blocks
    langPrefix: 'language-',
    
    // Autoconvert URL-like text to links
    linkify: true,
    
    // Enable some language-neutral replacement + quotes beautification
    typographer: true,
    
    // Double + single quotes replacement pairs, when typographer enabled,
    // and smartquotes on. Could be either a String or an Array.
    quotes: '""\'\'',
});

/**
 * Convert markdown content to HTML with proper styling for both light and dark themes
 * @param {string} content - The markdown content to convert
 * @param {boolean} isDark - Whether dark theme is active
 * @returns {string} - The converted HTML string
 */
export function renderMarkdown(content, isDark = false) {
    if (!content) return '';
    
    let html = md.render(content);
    
    // Apply theme-specific styling for better integration with Vue components
    if (isDark) {
        // Force appropriate colors for dark theme
        html = html.replace(/<strong>/g, '<strong style="color: white; font-weight: 600;">');
        html = html.replace(/<b>/g, '<b style="color: white; font-weight: 600;">');
        html = html.replace(/<p>/g, '<p style="color: #d1d5db; margin-bottom: 0.5rem;">');
        html = html.replace(/<h([1-6])>/g, '<h$1 style="color: white; font-weight: 700;">');
        html = html.replace(/<code>/g, '<code style="background-color: #374151; color: #e5e7eb; padding: 2px 8px; border-radius: 4px;">');
    } else {
        // Light theme styling
        html = html.replace(/<strong>/g, '<strong style="color: #111827; font-weight: 700;">');
        html = html.replace(/<b>/g, '<b style="color: #111827; font-weight: 700;">');
        html = html.replace(/<p>/g, '<p style="color: #374151; margin-bottom: 0.5rem;">');
        html = html.replace(/<h([1-6])>/g, '<h$1 style="color: #111827; font-weight: 700;">');
        html = html.replace(/<code>/g, '<code style="background-color: #f3f4f6; color: #1f2937; padding: 2px 4px; border-radius: 4px;">');
    }
    
    return html;
}

/**
 * Simple version that just processes content without theme styling
 * Useful for cases where CSS handles the styling
 * @param {string} content - The markdown content to convert
 * @returns {string} - The converted HTML string
 */
export function renderMarkdownSimple(content) {
    if (!content) return '';
    return md.render(content);
}

export default {
    renderMarkdown,
    renderMarkdownSimple,
};