#!/bin/bash

# Neovim Copilot Chat Setup Script for BoolBnB Laravel Project
# This script helps set up Neovim with GitHub Copilot Chat for Laravel development

set -e

echo "🚀 Setting up Neovim with GitHub Copilot Chat for Laravel development..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check prerequisites
check_prerequisites() {
    print_status "Checking prerequisites..."
    
    # Check for nvim
    if ! command -v nvim &> /dev/null; then
        print_error "Neovim is not installed. Please install Neovim 0.8+ first."
        echo "Visit: https://github.com/neovim/neovim/releases"
        exit 1
    fi
    
    # Check nvim version
    nvim_version=$(nvim --version | head -n1 | cut -d' ' -f2)
    print_success "Found Neovim $nvim_version"
    
    # Check for git
    if ! command -v git &> /dev/null; then
        print_error "Git is not installed. Please install Git first."
        exit 1
    fi
    print_success "Git is available"
    
    # Check for node (required for Copilot)
    if ! command -v node &> /dev/null; then
        print_warning "Node.js is not installed. GitHub Copilot requires Node.js."
        echo "You can continue, but you'll need to install Node.js for Copilot to work."
        echo "Visit: https://nodejs.org/"
    else
        node_version=$(node --version)
        print_success "Found Node.js $node_version"
    fi
}

# Setup configuration
setup_config() {
    echo
    print_status "Choose installation method:"
    echo "1) Global configuration (replaces existing ~/.config/nvim/init.lua)"
    echo "2) Project-specific configuration (creates ~/.config/nvim-boolbnb/)"
    echo "3) Backup existing config and install globally"
    echo "4) Just show the config file location (no installation)"
    
    read -p "Enter your choice (1-4): " choice
    
    case $choice in
        1)
            install_global
            ;;
        2)
            install_project_specific
            ;;
        3)
            backup_and_install
            ;;
        4)
            show_config_location
            ;;
        *)
            print_error "Invalid choice. Exiting."
            exit 1
            ;;
    esac
}

install_global() {
    print_status "Installing global configuration..."
    
    # Create nvim config directory
    mkdir -p ~/.config/nvim
    
    # Copy the configuration
    cp .nvim/init.lua ~/.config/nvim/init.lua
    
    print_success "Configuration installed to ~/.config/nvim/init.lua"
    echo "Start Neovim to automatically install plugins: nvim"
}

install_project_specific() {
    print_status "Installing project-specific configuration..."
    
    # Create project-specific nvim config directory
    mkdir -p ~/.config/nvim-boolbnb
    
    # Copy the configuration
    cp .nvim/init.lua ~/.config/nvim-boolbnb/init.lua
    
    print_success "Project-specific configuration installed to ~/.config/nvim-boolbnb/"
    echo
    print_status "To use this configuration, add this alias to your shell profile:"
    echo "alias nvim-laravel='NVIM_APPNAME=nvim-boolbnb nvim'"
    echo
    echo "Then use: nvim-laravel filename.php"
}

backup_and_install() {
    print_status "Backing up existing configuration..."
    
    # Create nvim config directory
    mkdir -p ~/.config/nvim
    
    # Backup existing config if it exists
    if [ -f ~/.config/nvim/init.lua ]; then
        backup_name="init.lua.backup.$(date +%Y%m%d_%H%M%S)"
        cp ~/.config/nvim/init.lua ~/.config/nvim/$backup_name
        print_success "Backed up existing config to ~/.config/nvim/$backup_name"
    fi
    
    # Copy the configuration
    cp .nvim/init.lua ~/.config/nvim/init.lua
    
    print_success "New configuration installed to ~/.config/nvim/init.lua"
    echo "Start Neovim to automatically install plugins: nvim"
}

show_config_location() {
    print_status "Configuration files location:"
    echo "Main config: $(pwd)/.nvim/init.lua"
    echo "Documentation: $(pwd)/.nvim/README.md"
    echo "Install script: $(pwd)/.nvim/install.sh"
    echo
    echo "Manual installation:"
    echo "cp .nvim/init.lua ~/.config/nvim/init.lua"
}

# Post-installation instructions
show_post_install() {
    echo
    print_success "Setup complete! 🎉"
    echo
    print_status "Next steps:"
    echo "1. Start Neovim - plugins will install automatically"
    echo "2. Authenticate with GitHub Copilot: :Copilot setup"
    echo "3. Test Copilot Chat: :CopilotChat"
    echo
    print_status "Key bindings:"
    echo "- <Space>cc : Open Copilot Chat"
    echo "- <Space>ce : Explain selected code (visual mode)"
    echo "- <Space>cf : Fix selected code (visual mode)"
    echo "- <Space>ct : Generate tests for selected code (visual mode)"
    echo
    print_status "Laravel commands:"
    echo "- <Space>la : Run artisan command"
    echo "- <Space>lt : Run PHPUnit tests"
    echo "- <Space>lm : Run migrations"
    echo
    echo "📖 For detailed documentation, see: .nvim/README.md"
    echo "❓ For troubleshooting, check the README or GitHub issues"
}

# Main execution
main() {
    echo "🎯 BoolBnB Laravel - Neovim Copilot Chat Installer"
    echo "=================================================="
    echo
    
    # Check if we're in the right directory
    if [ ! -f ".nvim/init.lua" ]; then
        print_error "Please run this script from the root of the boolbnb-laravel repository"
        print_error "The .nvim/init.lua file was not found"
        exit 1
    fi
    
    check_prerequisites
    setup_config
    
    if [ "$choice" != "4" ]; then
        show_post_install
    fi
}

# Run main function
main