#!/bin/bash

# Test script to validate the nvim setup
# This script checks that all configuration files are present and valid

echo "🧪 Testing Neovim Copilot Chat Setup..."
echo "======================================"

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

success_count=0
total_tests=0

# Test function
run_test() {
    local test_name="$1"
    local test_command="$2"
    
    total_tests=$((total_tests + 1))
    printf "Testing %-40s" "$test_name..."
    
    if eval "$test_command" > /dev/null 2>&1; then
        echo -e "${GREEN}✓ PASS${NC}"
        success_count=$((success_count + 1))
    else
        echo -e "${RED}✗ FAIL${NC}"
    fi
}

# Run tests
echo "Running configuration tests..."
echo

run_test "init.lua exists" "[ -f .nvim/init.lua ]"
run_test "init.lua is not empty" "[ -s .nvim/init.lua ]"
run_test "README.md exists" "[ -f .nvim/README.md ]"
run_test "README.md is not empty" "[ -s .nvim/README.md ]"
run_test "install.sh exists" "[ -f .nvim/install.sh ]"
run_test "install.sh is executable" "[ -x .nvim/install.sh ]"
run_test "minimal.lua exists" "[ -f .nvim/minimal.lua ]"
run_test "KEYBINDINGS.md exists" "[ -f .nvim/KEYBINDINGS.md ]"
run_test ".nvimrc exists" "[ -f .nvim/.nvimrc ]"

# Check file contents
run_test "init.lua contains CopilotChat" "grep -q 'CopilotChat' .nvim/init.lua"
run_test "init.lua contains lazy.nvim" "grep -q 'lazy.nvim' .nvim/init.lua"
run_test "init.lua contains Laravel prompts" "grep -q 'Laravel' .nvim/init.lua"
run_test "README updated with nvim section" "grep -q 'Neovim' README.md"

echo
echo "======================================"
echo -e "Test Results: ${GREEN}${success_count}/${total_tests}${NC} tests passed"

if [ $success_count -eq $total_tests ]; then
    echo -e "${GREEN}🎉 All tests passed! Setup is complete.${NC}"
    echo
    echo "Next steps:"
    echo "1. Run: ./.nvim/install.sh"
    echo "2. Start nvim and run: :Copilot setup"
    echo "3. Test with: :CopilotChat"
    exit 0
else
    echo -e "${RED}❌ Some tests failed. Please check the setup.${NC}"
    exit 1
fi