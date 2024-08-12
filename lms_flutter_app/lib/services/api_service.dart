import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/course.dart';

class ApiService {
  final String baseUrl = 'http://your-laravel-backend-url/api';

  Future<List<Course>> getCourses() async {
    final response = await http.get(Uri.parse('$baseUrl/courses'));
    if (response.statusCode == 200) {
      List<dynamic> body = json.decode(response.body);
      return body.map((dynamic item) => Course.fromJson(item)).toList();
    } else {
      throw Exception('Failed to load courses');
    }
  }

  Future<Course> getCourseDetails(int courseId) async {
    final response = await http.get(Uri.parse('$baseUrl/courses/$courseId'));
    if (response.statusCode == 200) {
      return Course.fromJson(json.decode(response.body));
    } else {
      throw Exception('Failed to load course details');
    }
  }

  Future<void> enrollCourse(int courseId) async {
    final response = await http.post(Uri.parse('$baseUrl/courses/$courseId/enroll'));
    if (response.statusCode != 200) {
      throw Exception('Failed to enroll in the course');
    }
  }

  Future<void> unenrollCourse(int courseId) async {
    final response = await http.delete(Uri.parse('$baseUrl/courses/$courseId/unenroll'));
    if (response.statusCode != 200) {
      throw Exception('Failed to unenroll from the course');
    }
  }

  Future<void> login(Map<String, dynamic> credentials) async {
    final response = await http.post(
      Uri.parse('$baseUrl/login'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(credentials),
    );
    if (response.statusCode != 200) {
      throw Exception('Failed to log in');
    }
  }

  Future<void> register(Map<String, dynamic> userData) async {
    final response = await http.post(
      Uri.parse('$baseUrl/register'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(userData),
    );
    if (response.statusCode != 201) {
      throw Exception('Failed to register');
    }
  }

  Future<void> logout() async {
    final response = await http.post(Uri.parse('$baseUrl/logout'));
    if (response.statusCode != 200) {
      throw Exception('Failed to log out');
    }
  }
}
