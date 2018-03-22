// This is integration test for products controller.

package controller

import (
	"encoding/json"
	"github.com/labstack/echo"
	"net/http/httptest"
	"regexp"
	"testing"
)

// TestGetProduct - test "get product" end-point.
func TestGetProduct(t *testing.T) {
	req := httptest.NewRequest(echo.GET, "/products/mTd3lb", nil)
	rec := httptest.NewRecorder()
	c := echo.New().NewContext(req, rec)
	c.SetPath("/products/:id")
	c.SetParamNames("id")
	c.SetParamValues("mTd3lb")

	GetProduct(c)
	actual := rec.Body.String()

	// Actual result is pretty cumbersome,
	// that's why for this test-case it's must be ok just check response against regex pattern,
	// and ensure that response contains product with desired id.
	match, _ := regexp.MatchString(`"id": "mTd3lb"`, actual)
	if !match {
		t.Errorf("FAIL GetProduct: actual result doesn't contain expected product id. Got: %s", actual)
	}
}

// TestGetAllProducts - test "get product" end-point.
func TestGetAllProducts(t *testing.T) {
	req := httptest.NewRequest(echo.GET, "/products", nil)
	rec := httptest.NewRecorder()
	c := echo.New().NewContext(req, rec)

	GetAllProducts(c)
	actual := rec.Body.String()

	// Actual result contains array of objects,
	// each object is product which is pretty big.
	// Also actual result response is known to contain valid JSON payload
	// hence it's possible to check in this test-case that response is valid JSON.
	var js json.RawMessage
	if json.Unmarshal([]byte(actual), &js) != nil {
		t.Errorf("FAIL TestGetAllProducts: actual result doesn't look like valid json. Got: %s", actual)
	}
}
