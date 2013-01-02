<?php

namespace dad\tests\factories;

class Messages extends \dad\models\Messages {

		public static function create(array $data = [], array $options = []) {
		$defaults = [
			'content' => "I find this a difficult question to answer with confidence.
						Personally I've always been a old fashioned classic TDDer and thus far I don't see any reason to change.
						I don't see any compelling benefits for mockist TDD, and am concerned about the consequences of coupling tests to implementation.
						<br />
						This has particularly struck me when I've observed a mockist programmer.
						I really like the fact that while writing the test you focus on the result of the behavior, not how it's done.
						A mockist is constantly thinking about how the SUT is going to be implemented in order to write the expectations. This feels really unnatural to me.
						<br />
						I also suffer from the disadvantage of not trying mockist TDD on anything more than toys. As I've learned from Test Driven Development itself,
						it's often hard to judge a technique without trying it seriously. I do know many good developers who are very happy and convinced mockists.
						So although I'm still a convinced classicist, I'd rather present both arguments as fairly as I can so you can make your own mind up.
						<br />
						So if mockist testing sounds appealing to you, I'd suggest giving it a try.
						It's particularly worth trying if you are having problems in some of the areas that mockist TDD is intended to improve.
						I see two main areas here. One is if you're spending a lot of time debugging when tests fail because they aren't breaking cleanly
						and telling you where the problem is. (You could also improve this by using classic TDD on finer-grained clusters.)
						The second area is if your objects don't contain enough behavior, mockist testing may encourage the development team to create more behavior rich objects.",
			'creator' => [
				'id' => new \MongoId(),
				'name' => 'Mehdi'
			]
		];
		$data += $defaults;

		return parent::create($data, $options);
	}
}

?>