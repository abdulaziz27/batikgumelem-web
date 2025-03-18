<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Redirect to the homepage controller
     */
    public function index(Request $request)
    {
        return app(HomeController::class)->index($request);
    }

    /**
     * Redirect to the product details controller
     */
    public function details(Request $request, $slug)
    {
        return app(ProductController::class)->show($request, $slug);
    }

    /**
     * Redirect to the cart controller
     */
    public function cart(Request $request)
    {
        return app(CartController::class)->index($request);
    }

    /**
     * Redirect to the cart add controller
     */
    public function cartAdd(Request $request, $id)
    {
        return app(CartController::class)->add($request, $id);
    }

    /**
     * Redirect to the cart delete controller
     */
    public function cartDelete(Request $request, $id)
    {
        return app(CartController::class)->delete($request, $id);
    }

    /**
     * Redirect to the checkout controller
     */
    public function checkout(Request $request)
    {
        return app(CheckoutController::class)->process($request);
    }

    /**
     * Redirect to the checkout success controller
     */
    public function success(Request $request)
    {
        return app(CheckoutController::class)->success($request);
    }

    /**
     * Redirect to the blog controller
     */
    public function blogs(Request $request)
    {
        return app(BlogController::class)->index($request);
    }

    /**
     * Redirect to the history page controller
     */
    public function history(Request $request)
    {
        return app(HomeController::class)->history($request);
    }

    /**
     * Redirect to the promotion page controller
     */
    public function promotion(Request $request)
    {
        return app(HomeController::class)->promotion($request);
    }

    /**
     * Redirect to the terms and conditions page controller
     */
    public function termsCondition(Request $request)
    {
        return app(HomeController::class)->termsCondition($request);
    }

    /**
     * Redirect to the privacy policy page controller
     */
    public function privacyPolicy(Request $request)
    {
        return app(HomeController::class)->privacyPolicy($request);
    }

    /**
     * Redirect to the FAQ page controller
     */
    public function faq(Request $request)
    {
        return app(HomeController::class)->faq($request);
    }
}
