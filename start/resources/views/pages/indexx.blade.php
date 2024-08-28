<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




    DB::table('sys_books')->insert([
        [	
			'book_id' => 'bmath01', 'title' => 'Basic Mathematics for Primary Schools 1', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Mathematics for Primary Schools, First Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 5000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'bmath02', 'title' => 'Basic Mathematics for Primary Schools 2', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Mathematics for Primary Schools, Second Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 5000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'beng01', 'title' => 'Basic English Language for Primary Schools 1', 'author' => 'Olagunju Whyte',
			'description' => 'Basic English Language for Primary Schools, First Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 6000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'beng02', 'title' => 'Basic English Language for Primary Schools 2', 'author' => 'Olagunju Whyte',
			'description' => 'Basic English Language for Primary Schools, Second Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 6000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'bsci01', 'title' => 'Basic Sciences for Primary Schools 1', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Sciences for Primary Schools, First Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 7000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'bsci02', 'title' => 'Basic Sciences for Primary Schools 2', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Sciences for Primary Schools, Second Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 7000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		], 
        [	
			'book_id' => 'bacct01', 'title' => 'Basic Accounting for Secondary Schools 1', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Accounting for Secondary Schools , First Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 10000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		],
        [	
			'book_id' => 'bacct02', 'title' => 'Basic Accounting for Secondary Schools 2', 'author' => 'Olagunju Whyte',
			'description' => 'Basic Accounting for Secondary Schools , Second Edition is a good choice for parents who want to teach their children math at home. The book is structured in a way that gradually increases in difficulty, making it suitable for children of different ages and math skill levels. The lessons are short and easy to understand, and each chapter ends with a test to help children Consolidate what they have learned. Although the starting point of "counting shapes" may be too basic for some children, it's still a good starting point for beginners.',
			'genre' => 'Educational', 'price' => 10000, 'availableQty' => 50,
			'deleted' => 0, 'deleted_by' => NULL, 'deleted_date' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),
		]
    ]);

        