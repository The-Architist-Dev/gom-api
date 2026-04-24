#!/bin/bash

echo "Testing CORS on Production..."
echo ""

# Test 1: OPTIONS preflight from Vercel
echo "Test 1: OPTIONS preflight from Vercel"
curl -X OPTIONS https://thearchivist-edemdeeaf4ahamgs.southeastasia-01.azurewebsites.net/api/login/social \
  -H "Origin: https://thearchivistai.vercel.app" \
  -H "Access-Control-Request-Method: POST" \
  -H "Access-Control-Request-Headers: Content-Type, Authorization" \
  -v 2>&1 | grep -i "access-control"

echo ""
echo "---"
echo ""

# Test 2: Actual POST request
echo "Test 2: POST request from Vercel"
curl -X POST https://thearchivist-edemdeeaf4ahamgs.southeastasia-01.azurewebsites.net/api/login/social \
  -H "Origin: https://thearchivistai.vercel.app" \
  -H "Content-Type: application/json" \
  -d '{"provider":"google","token":"test"}' \
  -v 2>&1 | grep -i "access-control"

echo ""
echo "---"
echo ""

# Test 3: Health check
echo "Test 3: Health check"
curl https://thearchivist-edemdeeaf4ahamgs.southeastasia-01.azurewebsites.net/api/test

echo ""
echo ""
echo "Expected headers:"
echo "  Access-Control-Allow-Origin: https://thearchivistai.vercel.app"
echo "  Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH"
echo "  Access-Control-Allow-Credentials: true"
