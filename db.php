<?php
<<<<<<< HEAD
// FILE-BASED DATABASE: No MySQL / SQL is used.
return array (
  'settings' => 
  array (
    'clinic_name' => 'Satva Homoeopathy & Genetic Research Center',
    'tagline' => 'Natural Care. Personalized Healing.',
    'doctor_name' => 'Dr. Chirag Patel',
    'qualification' => 'BHMS, Consulting Homoeopath',
    'phone' => '+91 00000 00000',
    'email' => 'info@example.com',
    'address' => 'Your Clinic Address, Surat, Gujarat',
    'hero_title' => 'Gentle Care. Natural Healing. Better You.',
    'hero_text' => 'Personalized homeopathic care with a patient-first approach for your long-term wellness.',
    'primary_color' => '#035b40',
    'light_color' => '#035b40',
    'medium_color' => '#04845f',
    'admin_user' => 'admin',
    'admin_password' => 'admin123',
  ),
  'patients' => 
  array (
    0 => 
    array (
      'id' => '7a94306144ed6af9',
      'number' => 'PAT-000004',
      'name' => 'Zeels Kachhadiya',
      'dob' => '2004-08-22',
      'age' => 22,
      'city' => 'Surat',
      'state' => 'Gujarat',
      'country' => 'India',
      'address' => 'YOGI CHOWK, SURAT',
      'mobile' => '09979916209',
      'gender' => 'Male',
      'blood_group' => 'A-',
      'created_at' => '2026-08-23 06:52:02',
      'source_inquiry_id' => 'ee44675a84b5e3a0',
    ),
  ),
  'appointments' => 
  array (
    0 => 
    array (
      'id' => 'de47e2c08be61214',
      'number' => 'APT-000004',
      'patient_id' => '7a94306144ed6af9',
      'date' => '0200-10-29',
      'time' => '23:00',
      'status' => 'Completed',
      'amount' => 0.0,
      'medicine' => 'dfsadfds',
      'instructions' => 'asfsdafsd',
      'next_date' => '',
      'created_at' => '2026-08-23 06:52:02',
      'source_inquiry_id' => 'ee44675a84b5e3a0',
    ),
  ),
  'inquiries' => 
  array (
    0 => 
    array (
      'id' => 'ee44675a84b5e3a0',
      'type' => 'Appointment Request',
      'name' => 'Zeels Kachhadiya',
      'mobile' => '09979916209',
      'email' => 'pedanav566@litepax.com',
      'message' => 'asdf',
      'appointment_date' => '0200-10-29',
      'appointment_time' => '23:00',
      'dob' => '2004-08-22',
      'age' => 22,
      'city' => 'Surat',
      'state' => 'Gujarat',
      'country' => 'India',
      'address' => 'YOGI CHOWK, SURAT',
      'gender' => 'Male',
      'blood_group' => 'A-',
      'created_at' => '2026-08-22 17:27:59',
      'status' => 'Converted',
    ),
  ),
  'blogs' => 
  array (
  ),
  'gallery' => 
  array (
    0 => 
    array (
      'id' => 'ef581fae49d5dbc3',
      'name' => 'Zeels',
      'image' => 'uploads/20260822180332_d567ca55.jpg',
      'created_at' => '2026-08-22 18:03:32',
    ),
    1 => 
    array (
      'id' => 'cb7616eb419b1c6e',
      'name' => 'Zeels Kachhadiya',
      'image' => 'uploads/20260822180625_ae6d9b39.png',
      'created_at' => '2026-08-22 18:06:25',
    ),
    2 => 
    array (
      'id' => 'c6faba88233fe36c',
      'name' => 'SDFSDF',
      'image' => 'uploads/20260822181206_a45bdef8.jpg',
      'created_at' => '2026-08-22 18:12:06',
    ),
    3 => 
    array (
      'id' => '5d06926950db9232',
      'name' => 'SDFSDF',
      'image' => 'uploads/20260822181206_265d09d0.png',
      'created_at' => '2026-08-22 18:12:06',
    ),
    4 => 
    array (
      'id' => '00e5fcb95f95ee70',
      'name' => 'SDFSDF',
      'image' => 'uploads/20260822181206_ad9373fc.webp',
      'created_at' => '2026-08-22 18:12:06',
    ),
  ),
);
=======
/**
 * Janani Homeopathy - File Database
 * ---------------------------------------------------------
 * NO SQL / NO MySQL.
 * All editable website data is stored in this PHP array.
 *
 * IMPORTANT:
 * 1. Keep this file writable by PHP for the admin panel.
 * 2. Change the default admin password from Admin > Settings.
 * 3. For production, ideally keep db.php outside public web root
 *    or block direct access to *.php data files at server level.
 */
return [
    'settings' => [
        'site_name' => 'Janani Homeopathy',
        'tagline' => 'Gentle, Individualised Homeopathic Care',
        'doctor_name' => 'Dr. Chirag Patel',
        'doctor_qualification' => 'BHMS, CCPH, SCPH',
        'experience' => '12+ Years',
        'city' => 'Surat, Gujarat',
        'phone' => '',
        'email' => '',
        'address' => '',
        'linkedin' => 'https://www.linkedin.com/in/dr-chirag-patel-b005b6185',
        'whatsapp' => '',
        'facebook' => '',
        'instagram' => '',
        'youtube' => '',
        'meta_description' => 'Janani Homeopathy offers personalised homeopathic consultation and supportive care in Surat with a patient-first approach.',
        'keywords' => 'homeopathy in Surat, homeopathic doctor Surat, Janani Homeopathy, Dr Chirag Patel, homeopathic treatment Surat',
        'footer_text' => 'Compassionate care, thoughtful consultation and personalised homeopathic support.',
    ],

    'admin' => [
        'username' => 'admin',
        'password_hash' => '$2y$12$fwIYoF0/xd0739uXXgbdf.fWx4ZA/87Lxp1bPmREJcVLPoAjIHGOC',
    ],

    'services' => [
        [
            'id' => 1,
            'title' => 'Homeopathy Treatment',
            'slug' => 'homeopathy-treatment',
            'meta' => 'Personalised homeopathic consultation in Surat.',
            'intro' => 'Personalised homeopathic consultation in Surat.',
            'lead' => 'A consultation-led approach that looks at the individual rather than treating a keyword or symptom in isolation.',
            'benefit' => 'Homeopathic care is individualised and begins with a detailed conversation about your concerns and health history.',
            'expect' => 'The consultation focuses on understanding your symptoms, patterns, history, routine and goals so the doctor can explain an appropriate care approach.',
            'body' => "Every patient is different. A consultation should consider the person's symptoms, history, lifestyle and any previous medical care. This service page is intentionally written as a flexible base that the clinic can edit manually with its own verified information, FAQs and clinical guidance.",
            'concerns' => ['Homeopathic consultation', 'Individualised consultation', 'Follow-up consultation', 'Health and lifestyle discussion', 'General wellness guidance'],
            'status' => 'published',
        ],
        [
            'id' => 2,
            'title' => 'Skin Problems',
            'slug' => 'skin-problems',
            'meta' => 'Homeopathic treatment for skin conditions in Surat.',
            'intro' => 'Comprehensive homeopathic support for skin health.',
            'lead' => 'Skin conditions often reflect overall wellness. A thorough consultation helps identify underlying factors.',
            'benefit' => 'Homeopathic approach considers your complete health picture, not just skin symptoms.',
            'expect' => 'Detailed consultation about symptoms, triggers, lifestyle and health history to develop a personalised plan.',
            'body' => 'Skin health depends on multiple factors including digestion, stress, lifestyle and heredity. Homeopathic care addresses these comprehensively.',
            'concerns' => ['Acne', 'Eczema', 'Psoriasis', 'Dermatitis', 'Allergic reactions', 'Fungal infections'],
            'status' => 'published',
        ],
        [
            'id' => 3,
            'title' => 'Hair Problems',
            'slug' => 'hair-problems',
            'meta' => 'Homeopathic treatment for hair loss and hair care in Surat.',
            'intro' => 'Homeopathic support for hair health and hair loss concerns.',
            'lead' => 'Hair health reflects nutritional, hormonal and emotional wellbeing.',
            'benefit' => 'A comprehensive approach that addresses root causes of hair problems.',
            'expect' => 'Consultation about hair concerns, general health, nutrition, stress levels and family history.',
            'body' => 'Hair loss and other hair conditions can have multiple underlying factors. Homeopathic consultation helps identify and address these comprehensively.',
            'concerns' => ['Hair loss', 'Premature greying', 'Hair thinning', 'Scalp conditions', 'Brittle hair'],
            'status' => 'published',
        ],
        [
            'id' => 4,
            'title' => 'Women Health',
            'slug' => 'women-health',
            'meta' => 'Homeopathic support for women health concerns in Surat.',
            'intro' => 'Personalised homeopathic care for women health concerns across all life stages.',
            'lead' => 'Women experience unique health needs across different life stages.',
            'benefit' => 'Homeopathic approach provides individualised support for hormonal and reproductive health.',
            'expect' => 'Detailed consultation about symptoms, menstrual history, lifestyle and overall wellbeing.',
            'body' => 'From reproductive health to menopausal concerns, homeopathy offers a gentle, individualised approach.',
            'concerns' => ['Menstrual issues', 'Fertility concerns', 'Menopausal symptoms', 'Hormonal balance', 'Reproductive health'],
            'status' => 'published',
        ],
        [
            'id' => 5,
            'title' => 'Child Care',
            'slug' => 'child-care',
            'meta' => 'Homeopathic care for children in Surat.',
            'intro' => 'Gentle homeopathic support for children health concerns.',
            'lead' => 'Children benefit from individualised, gentle care approaches.',
            'benefit' => 'Homeopathy provides non-invasive support for common childhood health concerns.',
            'expect' => 'Consultation about symptoms, family health history, development and lifestyle.',
            'body' => 'Homeopathic care for children focuses on understanding their unique constitution and needs.',
            'concerns' => ['Common illnesses', 'Allergies', 'Digestive concerns', 'Sleep issues', 'Immune support'],
            'status' => 'published',
        ],
        [
            'id' => 6,
            'title' => 'Lifestyle Disorders',
            'slug' => 'lifestyle-disorders',
            'meta' => 'Homeopathic treatment for lifestyle-related health conditions in Surat.',
            'intro' => 'Homeopathic support for conditions related to modern lifestyle and stress.',
            'lead' => 'Many health challenges today stem from lifestyle factors and stress.',
            'benefit' => 'Homeopathic approach helps address both symptoms and underlying lifestyle factors.',
            'expect' => 'Comprehensive consultation about daily routine, stress, diet, sleep and health concerns.',
            'body' => 'Lifestyle disorders often involve multiple factors. Homeopathy supports long-term health through comprehensive, individualised consultation.',
            'concerns' => ['Stress and anxiety', 'Sleep disorders', 'Digestive issues', 'Blood pressure concerns', 'Weight management'],
            'status' => 'published',
        ],
        [
            'id' => 7,
            'title' => 'Allergy Treatment',
            'slug' => 'allergy-treatment',
            'meta' => 'Homeopathic treatment for allergies in Surat.',
            'intro' => 'Homeopathic approach to understanding and managing allergic reactions.',
            'lead' => 'Allergies often indicate an imbalanced immune response.',
            'benefit' => 'Homeopathic consultation identifies triggers and underlying immune factors.',
            'expect' => 'Detailed discussion of allergic symptoms, triggers, timing and overall health patterns.',
            'body' => 'Rather than just managing symptoms, homeopathy seeks to understand why the body is reacting.',
            'concerns' => ['Seasonal allergies', 'Food sensitivities', 'Environmental allergies', 'Allergic reactions', 'Immune support'],
            'status' => 'published',
        ],
    ],

    'blogs' => [
        [
            'id' => 1,
            'title' => 'Understanding Individualised Homeopathic Care',
            'slug' => 'understanding-individualised-homeopathic-care',
            'excerpt' => 'Learn why a detailed consultation and an individualised approach are important in homeopathic care.',
            'content' => '<p>Homeopathic consultation begins with understanding the person, their concerns, history, routine and overall wellbeing. An individualised consultation helps the practitioner understand the patient beyond a single symptom.</p><p>This article is for general education only and is not a substitute for professional medical advice.</p>',
            'image' => '',
            'author' => 'Janani Homeopathy',
            'status' => 'published',
            'created_at' => '2026-08-18 10:00:00',
            'updated_at' => '2026-08-18 10:00:00',
        ],
        [
            'id' => 2,
            'title' => 'Everyday Habits That Support Better Wellbeing',
            'slug' => 'everyday-habits-that-support-better-wellbeing',
            'excerpt' => 'Simple lifestyle habits can support your overall wellbeing alongside appropriate professional care.',
            'content' => '<p>Regular sleep, balanced nutrition, hydration, movement and stress management are practical foundations for wellbeing. Consistency is often more useful than trying to change everything at once.</p><p>Always seek qualified medical guidance for persistent, severe or concerning symptoms.</p>',
            'image' => '',
            'author' => 'Janani Homeopathy',
            'status' => 'published',
            'created_at' => '2026-08-18 10:30:00',
            'updated_at' => '2026-08-18 10:30:00',
        ],
    ],

    'testimonials' => [
        [
            'id' => 1,
            'name' => 'Patient Review',
            'role' => 'Janani Homeopathy',
            'message' => 'A placeholder testimonial is included so you can replace it with an approved patient review from the admin panel.',
            'rating' => 5,
            'status' => 'published',
        ],
    ],

    'enquiries' => [],
];
>>>>>>> bda632c62c755cac8c67ec97d65083b1a3585c71
