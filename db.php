<?php
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
