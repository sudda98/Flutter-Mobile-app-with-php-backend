import 'package:flutter/material.dart';
import '../services/api_service.dart';

class AuthProvider with ChangeNotifier {
  final ApiService _apiService = ApiService();
  bool _isAuthenticated = false;

  bool get isAuthenticated => _isAuthenticated;

  Future<void> login(String email, String password) async {
    try {
      await _apiService.login({'email': email, 'password': password});
      _isAuthenticated = true;
      notifyListeners();
    } catch (error) {
      throw error;
    }
  }

  Future<void> register(String name, String email, String password) async {
    try {
      await _apiService.register({
        'name': name,
        'email': email,
        'password': password,
        'password_confirmation': password,
      });
    } catch (error) {
      throw error;
    }
  }

  Future<void> logout() async {
    try {
      await _apiService.logout();
      _isAuthenticated = false;
      notifyListeners();
    } catch (error) {
      throw error;
    }
  }
}
